@extends('admin.layouts.app')

@section('title', 'Page Editor')
@section('page_title', 'Page Editor')

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>Page Editor</h2>
                <p class="admin-card-subtitle">Customize every page and section of your website.</p>
            </div>
        </div>

        <div class="pages-tree">
            @foreach ($pages as $page)
                @include('admin.pages.partials.tree-item', ['page' => $page, 'depth' => 0])
            @endforeach
        </div>
    </div>
@endsection
