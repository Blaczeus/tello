<?php

namespace App\Filters;

use Illuminate\Http\Request;

class TaskFilters
{
    protected $request;
    protected $builder;

    protected $statusMap = [
        'todo' => 'new',
        'in_progress' => 'pending',
        'completed' => 'completed',
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        $this->filterByStatus()
                    ->filterBySearch()
                    ->filterByDateRange()
                    ->applySort();

        return $this->builder;
    }

    protected function filterByStatus()
    {
        $status = $this->request->get('status', 'all');

        if ($status !== 'all' && isset($this->statusMap[$status])) {
            $this->builder->where('status', $this->statusMap[$status]);
        }

        return $this;
    }

    protected function filterBySearch()
    {
        $search = $this->request->get('search');

        if ($search) {
            $this->builder->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        return $this;
    }

    protected function filterByDateRange()
    {
        if ($this->request->filled('date_from')) {
            $this->builder->whereDate('created_at', '>=', $this->request->get('date_from'));
        }

        if ($this->request->filled('date_to')) {
            $this->builder->whereDate('created_at', '<=', $this->request->get('date_to'));
        }

        return $this;
    }

    protected function applySort()
    {
        $sort = $this->request->get('sort');

        switch ($sort) {
            case 'oldest':
                $this->builder->orderBy('created_at', 'asc');
                break;
            case 'title-asc':
                $this->builder->orderBy('title', 'asc');
                break;
            case 'title-desc':
                $this->builder->orderBy('title', 'desc');
                break;
            default:
                $this->builder->orderBy('created_at', 'desc');
                break;
        }
                   
        return $this;
    }
}
