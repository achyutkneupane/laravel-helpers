<?php

namespace AchyutN\LaravelHelpers\Traits;

use AchyutN\LaravelHelpers\Scope\ApprovedScope;

trait CanBeApproved
{
    /**
     * Boot the approve trait for a model.
     *
     * @return void
     */
    public static function bootCanBeApproved(): void
    {
        static::addGlobalScope(new ApprovedScope());
    }

    /**
     * Initialize approve trait for an instance.
     *
     * @return void
     */

    public function initializeCanBeApproved(): void
    {
        if (!isset($this->casts[$this->getApprovedAtColumn()])) {
            $this->casts[$this->getApprovedAtColumn()] = 'datetime';
        }
        if (!isset($this->casts[$this->getRejectedAtColumn()])) {
            $this->casts[$this->getRejectedAtColumn()] = 'datetime';
        }

    }

    /**
     * Get the name of the "approved at" column.
     *
     * @return string
     */
    public function getApprovedAtColumn(): string
    {
        return defined(static::class . '::APPROVED_AT') ? static::APPROVED_AT : 'approved_at';
    }

    /**
     * Get the name of the "rejected at" column.
     *
     * @return string
     */
    public function getRejectedAtColumn(): string
    {
        return defined(static::class . '::REJECTED_AT') ? static::REJECTED_AT : 'rejected_at';
    }


    /**
     * Get the fully qualified "approved at" column.
     *
     * @return string
     */
    public function getQualifiedApprovedAtColumn(): string
    {
        return $this->qualifyColumn($this->getApprovedAtColumn());
    }

    /**
     * Get the fully qualified "rejected at" column.
     *
     * @return string
     */
    public function getQualifiedRejectedAtColumn(): string
    {
        return $this->qualifyColumn($this->getRejectedAtColumn());
    }

    /**
     * Approve the model.
     *
     * @return bool
     */
    public function setApproved(): bool
    {
        $this->{$this->getApprovedAtColumn()} = $this->freshTimestamp();
        $this->{$this->getRejectedAtColumn()} = null;
        return $this->save();
    }

    /**
     * Reject the model.
     *
     * @return bool
     */

    public function setRejected(): bool
    {
        $this->{$this->getRejectedAtColumn()} = $this->freshTimestamp();
        $this->{$this->getApprovedAtColumn()} = null;

        return $this->save();
    }

    /**
     * Set the model as pending.
     *
     * @return bool
     */
    public function setPending(): bool
    {
        $this->{$this->getRejectedAtColumn()} = null;
        $this->{$this->getApprovedAtColumn()} = null;

        return $this->save();
    }


}
