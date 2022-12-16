<?php

namespace JobMetric\GlobalVariable\Object;

class Config
{
    private static Config $instance;

    private array $data = [];

    /**
     * get instance object
     *
     * @return Config
     */
    public static function getInstance(): Config
    {
        if (empty(Config::$instance)) {
            Config::$instance = new Config();
        }

        return Config::$instance;
    }

    /**
     * set all config
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setAll($value): void
    {
        $this->data = $value;
    }

    /**
     * set config
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * get config
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return (isset($this->data[$key])) ? $this->data[$key] : $default;
    }

    /**
     * get code config
     *
     * @param string $code
     *
     * @return array
     */
    public function code(string $code): array
    {
        $config = [];
        foreach ($this->data as $key => $value) {
            if (substr($key, 0, strlen($code)) == $code) {
                $config[$key] = $this->data[$key];
            }
        }

        return $config;
    }

    /**
     * has config
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * get all config
     *
     * @return array
     */
    public function all(): array
    {
        return $this->data;
    }
}
