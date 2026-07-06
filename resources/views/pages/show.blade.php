@extends('layouts.app')

@section('title', $page->seo_title ?? $page->title ?? config('app.name'))
@section('meta_description', $page->seo_description ?? '')

@section('content')
    @foreach($page->getRenderedBlocks() as $block)
        @includeIf("blocks.{$block['type']}", ['data' => $block['data']])
    @endforeach
@endsection
