<?php namespace App\Models;

use App\Helpers\LumenHelper;

class JSON
{

    /** @var $files \Illuminate\Filesystem\Filesystem */
    /** @var $logger \Illuminate\Log\Logger */
    protected $lumenHelper, $files, $logger;

    /**
     * @var $path string
     * @var $bin mixed
     */
    private $path, $bin;

    /**
     * JSON constructor.
     * @param LumenHelper $lumenHelper
     * @param $path
     */
    public function __construct(LumenHelper $lumenHelper, $path)
    {
        $this->path = $path;
        $this->lumenHelper = $lumenHelper;
        $this->files = $this->lumenHelper->make('files');
        $this->logger = $this->lumenHelper->make('log');
        $this->bin = [];
        $this->initBin();
    }

    /**
     * Init Storage Bin
     */
    private function initBin()
    {
        try {
            $this->touchFile();
            $this->bin = json_decode($this->files->get($this->path), true);
        } catch (\Exception $e) {
            $this->logger->info("JSON Storage Error: {$e}");
        }
    }

    /**
     * Forget Key / Value Pair
     * @param $key
     * @return $this
     */
    public function forget($key)
    {
        unset($this->bin[$key]);
        return $this;
    }

    /**
     * @param $request array (key/value pair)
     * @param bool $overwrite
     * @return $this
     */
    public function set($request, $overwrite = true)
    {
        $this->bin[$request['key']] = $request['value'];
        return $this;
    }

    /**
     * @param $key
     * @param null $default
     * @return $this
     */
    public function get($key, $default = null)
    {
        return isset($this->bin[$key['key']]) ? $this->bin[$key['key']] : $default;
    }

    /**
     * @return null
     */
    public function all()
    {
        return $this->bin;
    }

    /**
     * @return $this
     */
    public function save()
    {
        $this->touchFile();
        $this->files->put($this->path, json_encode($this->bin, true));
        return $this;
    }

    /**
     * @return $this
     */
    private function touchFile()
    {
        if (!$this->files->isFile($this->path)) {
            $this->files->put($this->path, '');
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function flush()
    {
        $this->touchFile();
        $this->files->put($this->path, '');
        return $this;
    }
}