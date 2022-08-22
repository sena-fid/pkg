@extends('template.template')
@section('content')

<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row g-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="title-area">
                        <div class="page-pretitle">Teklif Formu</div>
                        <h2 class="page-title">Ürünler</h2>
                    </div>
                    <div class="actions-area">
                        <div class="btn-list">
                            <div class="dropdown">
                                <button type="button" class="btn btn-white dropdown-toggle" id="dropdownProduct" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-block">İşlemler</span>
                                    <span class="d-block d-sm-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1 me-0 mx-xs-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="14" cy="6" r="2"></circle><line x1="4" y1="6" x2="12" y2="6"></line><line x1="16" y1="6" x2="20" y2="6"></line><circle cx="8" cy="12" r="2"></circle><line x1="4" y1="12" x2="6" y2="12"></line><line x1="10" y1="12" x2="20" y2="12"></line><circle cx="17" cy="18" r="2"></circle><line x1="4" y1="18" x2="15" y2="18"></line><line x1="19" y1="18" x2="20" y2="18"></line></svg>
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProduct">
                                    <li><a class="dropdown-item" href="kategoriler.html">Kategoriler</a></li>
                                    <li><a class="dropdown-item" href="markalar.html">Markalar</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" data-bs-toggle="offcanvas" href="#offcanvasBulkProduct" aria-controls="offcanvasBulkProductLabel">Toplu Ürün Ekle</a></li>
                                </ul>
                            </div>
                            <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasProduct" role="button" aria-controls="offcanvasProductLabel">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-xs-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <span class="d-none d-sm-block">Ürün Ekle</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-4">
                <div class="col-lg-3">
                    <form action="{{ route('product.search') }}" method="post">
                        @csrf
                        <div class="subheader mb-1">Ürün Adı</div>
                        <div class="mb-3">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                                </span>
                                <input type="text" name="title" class="form-control" placeholder="Ürün Adı..." aria-label="Ürün Adı">
                            </div>
                        </div>
                        <div class="subheader mb-1">Kategoriler</div>
                        <div class="mb-3">

                            @foreach ($categories as $item)
                                <label class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" name="category_id[]" value="{{ $item->id }}">
                                    <span class="form-check-label">{{ $item->title }}</span>
                                </label>
                            @endforeach

                        </div>
                        <div class="subheader mb-1">Marka</div>
                        <div class="mb-3">
                            <select name="brand_id" class="form-select">
                                <option value="">Seçiniz...</option>
                                @foreach ($brands as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5"></path>
                                </svg>
                                Ürünleri Filtrele
                            </button>
                            <button type="reset" class="btn btn-link w-100" role="button">Temizle</a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Ürün Adı</th>
                                                <th>Fiyatı</th>
                                                <th>Kategori</th>
                                                <th>Marka</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($searchData as $item)
                                                <tr>
                                                    <td >{{ $item->title }}</td>
                                                    <td class="text-muted" >{{ $item->price_type ?? null }} {{ $item->price ?? "-"}}</td>
                                                    <td class="text-muted" >{{ $item->category->title ?? '-' }}</td>
                                                    <td class="text-muted" >{{ $item->brand->title ?? '-' }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <circle cx="5" cy="12" r="1"></circle>
                                                                    <circle cx="12" cy="12" r="1"></circle>
                                                                    <circle cx="19" cy="12" r="1"></circle>
                                                                </svg>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="{{ route('product.detail', $item->id) }}">Ürün Bilgileri</a>
                                                                <a class="dropdown-item" href="{{ route('product.edit', $item->id) }}">Düzenle</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <ul class="pagination d-flex justify-content-center align-items-center mx-auto my-2 w-100">
                                                        {!! $searchData->links() !!}
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
