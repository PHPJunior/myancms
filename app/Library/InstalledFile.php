<?php
use Illuminate\Support\Facades\File;

/**
 * Created by PhpStorm.
 * User: Nyi Nyi Lwin
 * Date: 5/17/2016
 * Time: 8:25 AM
 */
class InstalledFile
{
    /**
     * Create installed file.
     *
     * @return int
     */
    public function create()
    {
        File::put(storage_path('installed'), '');
    }

    /**
     * Update installed file.
     *
     * @return int
     */
    public function update()
    {
        return $this->create();
    }
}