<?php namespace App\Models;
use App\Helpers\LumenHelper;
class JSON{
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
     * Init Storage Bin for the JSON storage file.
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
     * Forget Key / Value Pair in the JSON storage file.
     * @param $key
     * @return self
     */
    public function forget($key)
    {
        unset($this->bin[$key]);
        return $this;
    }

    /**
     * Set a key / value pair entry in the JSON storage file.
     * @param $request array (key/value pair)
     * @param bool $overwrite
     * @return self
     */
    public function set($request, $overwrite = true)
    {
        if(isset($request['key']) && isset($request['value'])){
            if(!empty($request['key'])){
                $this->bin[$request['key']] = $request['value'];
            }
        }
        return $this;
    }

    /**
     * Get a key / value pair entry from the JSON storage file.
     * @param $key
     * @param null $default
     * @return string
     */
    public function get($key, $default = null)
    {
        return isset($this->bin[$key]) && !empty($this->bin[$key]) ? $this->bin[$key] : $default;
    }

    /**
     * Get all entries from the JSON storage file.
     * @return array|null
     */
    public function all()
    {
        return $this->bin;
    }

    /**
     * Save the JSON storage file.
     * @return self
     */
    public function save()
    {
        $this->touchFile();
        $this->files->put($this->path, json_encode($this->bin, true));
        return $this;
    }

    /**
     * Touch the JSON storage file.
     * @return self
     */
    private function touchFile()
    {
        if (!$this->files->isFile($this->path)) {
            $this->files->put($this->path, '');
        }
        return $this;
    }

    /**
     * Flush the JSON storage file.
     * @return self
     */
    public function flush()
    {
        $this->touchFile();
        $this->files->put($this->path, '');
        return $this;
    }
}