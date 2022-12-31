<?php

namespace JobMetric\GlobalVariable\Http\Controllers;

use Illuminate\Http\JsonResponse;
use JobMetric\GlobalVariable\Object\Document;

class ManifestController
{
    /**
     * render manifest json for desktop application
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $json['name'] = __('base.pwa.name');
        $json['short_name'] = __('base.pwa.short_name');
        $json['description'] = __('base.pwa.description');
        $json['theme_color'] = Document::getInstance()->getThemeColor();
        $json['background_color'] = Document::getInstance()->getBackgroundColor();
        $json['display'] = 'standalone';
        $json['scope'] = '/';
        $json['start_url'] = '/';
        $json['icons'] = [
            [
                'purpose' => 'any',
                'src'   => asset(Document::getInstance()->getFavicon()),
                'sizes' => '144x144',
                'type'  => 'image/svg'
            ]/*,
            [
                'src'   => asset(Document::getInstance()->getFavicon()),
                'sizes' => '512x512',
                'type'  => 'image/svg'
            ],
            [
                'purpose' => 'maskable',
                'src'     => asset(Document::getInstance()->getFavicon()),
                'sizes'   => '192x192',
                'type'    => 'image/svg'
            ],
            [
                'purpose' => 'maskable',
                'src'     => asset(Document::getInstance()->getFavicon()),
                'sizes'   => '512x512',
                'type'    => 'image/svg'
            ]*/
        ];

        return response()->json($json)->header('Content-Type', 'application/manifest+json');
    }

    /**
     * render manifest json for desktop application
     *
     * @return JsonResponse
     */
    public function mobile(): JsonResponse
    {
        $json = [
            'name'             => 'Job Metric',
            'short_name'       => 'Job Metric',
            'description'      => 'Job Metric',
            'theme_color'      => '#fff',
            'background_color' => '#5827a7',
            'display'          => 'standalone',
            'scope'            => '/',
            'start_url'        => '/',
            'icons'            => [
                [
                    'src'   => 'assets/logos/favicon.svg',
                    'sizes' => '192x192',
                    'type'  => 'image/svg'
                ],
                [
                    'src'   => 'assets/logos/favicon.svg',
                    'sizes' => '512x512',
                    'type'  => 'image/svg'
                ],
                [
                    'purpose' => 'maskable',
                    'src'     => 'assets/logos/favicon.svg',
                    'sizes'   => '192x192',
                    'type'    => 'image/svg'
                ],
                [
                    'purpose' => 'maskable',
                    'src'     => 'assets/logos/favicon.svg',
                    'sizes'   => '512x512',
                    'type'    => 'image/svg'
                ],
            ],
        ];

        return response()->json($json);
    }
}
