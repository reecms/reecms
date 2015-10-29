<?php

namespace Ree\Services;

use Illuminate\Contracts\Routing\UrlGenerator;

class CocktailService
{
    protected $buildManifest;
    protected $themeManifest;
    protected $publicPath;

    /**
     * The Url generator instance
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * CocktailService constructor.
     *
     * @param string       $publicPath
     * @param UrlGenerator $url
     */
    public function __construct($publicPath, UrlGenerator $url)
    {
        $this->publicPath = $publicPath;
        $this->url = $url;

        $this->buildManifest = $this->loadManifest('build');
        $this->themeManifest = $this->loadManifest('theme');
    }

    /**
     * Resolve a path from the `build` directory
     *
     * @param $path
     *
     * @return string
     */
    public function resolveBuildAsset($path)
    {
        return $this->url->asset($this->resolvePath($path, $this->buildManifest, 'build'));
    }

    /**
     * Resolve a path from the `theme` directory
     *
     * @param $path
     *
     * @return string
     */
    public function resolveThemeAsset($path)
    {
        return $this->url->asset($this->resolvePath($path, $this->themeManifest, 'theme'));
    }

    /**
     * Resolve a path based on the manifest data
     *
     * @param $path
     * @param $manifest
     * @param $base
     *
     * @return string
     */
    protected function resolvePath($path, $manifest, $base)
    {
        if (!isset($manifest[$path])) {
            return "{$base}/{$path}";
        }

        return "{$base}/{$manifest[$path]}";
    }

    /**
     * Load the manifest file from a specific sub directory of the `public` folder
     *
     * @param $dir
     *
     * @return mixed
     */
    protected function loadManifest($dir)
    {
        $jsonContent = file_get_contents($this->publicPath . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . "rev-manifest.json");

        return json_decode($jsonContent, true);
    }

}
