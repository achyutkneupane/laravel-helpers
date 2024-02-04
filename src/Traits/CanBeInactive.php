<?php

namespace AchyutN\LaravelHelpers\Traits;

use AchyutN\LaravelHelpers\Scope\InactiveScope;

trait CanBeInactive
{
    /**
     * Boot the inactive trait for a model.
     *
     * @return void
     */
    public static function bootCanBeInactive(): void
    {
        static::addGlobalScope(new InactiveScope());
    }

    /**
     * Initialize inactive trait for an instance.
     *
     * @return void
     */

    public function initializeCanBeInactive(): void
    {
        if (! isset($this->casts[$this->getInactiveAtColumn()])) {
            $this->casts[$this->getInactiveAtColumn()] = 'datetime';
        }
    }

    /**
     * Get the name of the "inactive at" column.
     *
     * @return string
     */
    public function getInactiveAtColumn(): string
    {
        return defined(static::class.'::INACTIVE_AT') ? static::INACTIVE_AT : 'inactive_at';
    }


    /**
     * Get the fully qualified "inactive at" column.
     *
     * @return string
     */
    public function getQualifiedInactiveAtColumn(): string
    {
        return $this->qualifyColumn($this->getInactiveAtColumn());
    }

    /**
     * Inactivate the model.
     *
     * @return bool
     */
    public function setInactive(): bool
    {
        $this->{$this->getInactiveAtColumn()} = $this->freshTimestamp();
        return $this->save();
    }

    /**
     * Activate the model.
     *
     * @return bool
     */

    public function setActive(): bool
    {
        $this->{$this->getInactiveAtColumn()} = null;
        return $this->save();
    }



}
