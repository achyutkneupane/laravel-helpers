<?php

namespace AchyutN\LaravelHelpers\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ApprovedScope implements Scope
{
    /**
     * All of the extensions to be added to the builder.
     *
     * @var array
     */
    protected array $extensions = ['WithPending','OnlyPending','WithoutApproved','WithRejected','OnlyRejected','WithAll'];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereNotNull($model->getQualifiedApprovedAtColumn())->whereNull($model->getQualifiedRejectedAtColumn());
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    public function extend(Builder $builder): void
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }

    /**
     * Get the "approved at" column for the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return string
     */
    protected function getApprovedAtColumn(Builder $builder): string
    {
        if (count((array)$builder->getQuery()->joins) > 0) {
            return $builder->getModel()->getQualifiedApprovedAtColumn();
        }

        return $builder->getModel()->getQualifiedApprovedAtColumn();
    }

    /**
     * Get the "rejected at" column for the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return string
     */
    protected function getRejectedAtColumn(Builder $builder): string
    {
        if (count((array)$builder->getQuery()->joins) > 0) {
            return $builder->getModel()->getQualifiedRejectedAtColumn();
        }

        return $builder->getModel()->getQualifiedRejectedAtColumn();
    }

    /**
     * Add the with-pending extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addWithPending(Builder $builder): void
    {
        $builder->macro('withPending', function (Builder $builder) {

            return $builder->withoutGlobalScope($this)->whereNull(
                $this->getRejectedAtColumn($builder)
            );
        });
    }

    /**
     * Add the without-pending extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addOnlyPending(Builder $builder): void
    {
        $builder->macro('OnlyPending', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->whereNull(
                $model->getQualifiedApprovedAtColumn()
            )->WhereNull(
                $model->getQualifiedRejectedAtColumn()
            );

            return $builder;
        });
    }

    /**
     * Add the without-approved extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addWithoutApproved(Builder $builder): void
    {
        $builder->macro('withoutApproved', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->whereNull(
                $model->getQualifiedApprovedAtColumn()
            );

            return $builder;
        });
    }

    /**
     * Add the with-rejected extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addWithRejected(Builder $builder): void
    {
        $builder->macro('withRejected', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->whereNotNull(
                $model->getQualifiedRejectedAtColumn()
            )->whereNotNull(
                $model->getQualifiedApprovedAtColumn()
            );

            return $builder;
        });
    }

    /**
     * Add the only-rejected extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addOnlyRejected(Builder $builder): void
    {
        $builder->macro('onlyRejected', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->whereNotNull(
                $model->getQualifiedRejectedAtColumn()
            );

            return $builder;
        });
    }

    /**
     * Add the with-all extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    protected function addWithAll(Builder $builder): void
    {
        $builder->macro('withAll', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }



}
