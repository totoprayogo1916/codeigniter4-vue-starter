<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

function vite(string $filename, string $type = ''): string|array|null
{
    $devServer = 'http://localhost:' . getenv('VITE_PORT'); // sesuaikan dengan vite.config.js
    $manifestPath = FCPATH . '.vite/manifest.json';

    // 1. Cek apakah dev server jalan
    if (@fopen($devServer . '/@vite/client', 'r')) {
        // Kalau HMR aktif
        if ($type === 'js') {
            return <<<HTML
                <script type="module" src="{$devServer}/@vite/client"></script>
                <script type="module" src="{$devServer}/$filename"></script>
            HTML;
        }
        return null; // CSS di dev diinject otomatis oleh Vite
    }

    // 2. Kalau dev server tidak ada → fallback ke manifest.json
    if (!file_exists($manifestPath)) {
        return null;
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);
    if (!isset($manifest[$filename])) {
        return null;
    }

    $entry = $manifest[$filename];
    $result = [];

    // Ambil JS
    if (isset($entry['file'])) {
        $result['js'] = '/' . ltrim($entry['file'], '/');
    }

    // Ambil CSS
    if (isset($entry['css']) && is_array($entry['css'])) {
        $result['css'] = array_map(fn($css) => '/' . ltrim($css, '/'), $entry['css']);
    } else {
        $result['css'] = [];
    }

    if ($type === 'js' && isset($result['js'])) {
        return '<script type="module" src="'.base_url($result['js']).'"></script>';
    }

    if ($type === 'css') {
        if (!empty($result['css'])) {
            $tags = '';
            foreach ($result['css'] as $css) {
                $tags .= '<link rel="stylesheet" href="'.base_url($css).'">'."\n";
            }
            return $tags;
        }
        return '';
    }

    return $result ?: null;
}
