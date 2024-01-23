<?php

namespace AchyutN\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class InactiveScope implements Scope
{
    /**
     * All of the extensions to be added to the builder.
     *
     * @var array
     */
    protected array $extensions = ['WithInactive', 'WithoutInactive', 'OnlyInactive'];
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereNull($model->getQualifiedInactiveAtColumn());
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    public function extend(Builder $builder): void
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }


    /**
     * Get the "inactive at" column for the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return string
     */
    protected function getInactiveAtColumn(Builder $builder): string
    {
        if (count((array) $builder->getQuery()->joins) > 0) {
            return $builder->getModel()->getQualifiedInactiveAtColumn();
        }

        return $builder->getModel()->getQualifiedInactiveAtColumn();
    }

    /**
     * Add the with-inactive extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addWithInactive(Builder $builder): void
    {
        $builder->macro('withInactive', function (Builder $builder, $withTrashed = true) {
            if (! $withTrashed) {
                return $builder->withoutTrashed();
            }

            return $builder->withoutGlobalScope($this);
        });
    }

    /**
     * Add the without-inactive extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addWithoutInactive(Builder $builder): void
    {
        $builder->macro('withoutInactive', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->whereNull(
                $model->getQualifiedInactiveAtColumn()
            );

            return $builder;
        });
    }

    /**
     * Add the only-inactive extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */

    protected function addOnlyInactive(Builder $builder): void
    {
        $builder->macro('onlyInactive', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->whereNotNull(
                $model->getQualifiedInactiveAtColumn()
            );

            return $builder;
        });
    }

}
