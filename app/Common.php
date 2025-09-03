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
    $manifestPath = FCPATH . '.vite/manifest.json';

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
        $result['css'] = []; // selalu array
    }

    // Jika type ditentukan, kembalikan langsung script/link tag
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
        return ''; // kalau css kosong, kembalikan string kosong
    }

    // default: return array
    return $result ?: null;
}
