<?php
/**
 * Interface Observer
 * 定义抽象观察着角色
 *
 */

namespace Observer\interfaces;

interface Observer
{
    /**
     * 定义观察着的更新方法
     * @return mixed
     */
    public function update(string $actionName);
}
