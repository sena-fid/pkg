@extends('template.template')
@section('content')

<div class="page-wrapper">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row g-2">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="title-area">
                        <div class="page-pretitle">Ürünler</div>
                        <h2 class="page-title">Ürün Detay</h2>
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
                                    <li><a class="dropdown-item" href="{{ route('category.index') }}">Kategoriler</a></li>
                                    <li><a class="dropdown-item" href="{{ route('brand.index') }}">Markalar</a></li>
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
                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <h2 class="card-title">
                                            <span>{{ $product->title }}</span>
                                            <a href="{{ route('product.edit', $product->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                    <path d="M16 5l3 3"></path>
                                                </svg>
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-2">Seri No:</dt>
                                        <dd class="col-4">{{ $product->seri_no }}</dd>

                                        <dt class="col-2">Barkod No:</dt>
                                        <dd class="col-4">{{ $product->barcode_no }}</dd>

                                        <dt class="col-2">Fiyat:</dt>
                                        <dd class="col-4">{{ $product->price_type }} {{ $product->price }}</dd>

                                        <dt class="col-2">Birimi:</dt>
                                        <dd class="col-4">{{ $product->unit }}</dd>

                                        <dt class="col-2">Kategori:</dt>
                                        <dd class="col-10">{{ $product->category->title }}</dd>

                                        <dt class="col-2">Marka:</dt>
                                        <dd class="col-10">{{ $product->brand->title }}</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ürün Nitelikleri</h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <form action="{{ route('product.store.property') }}" method="POST" class="row row-cols-auto g-2 align-items-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="col-lg-6">
                                                <label class="form-label" for="nitelikAdi">Nitelik Adı</label>
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-playlist-add" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M19 8h-14"></path>
                                                            <path d="M5 12h9"></path>
                                                            <path d="M11 16h-6"></path>
                                                            <path d="M15 16h6"></path>
                                                            <path d="M18 13v6"></path>
                                                        </svg>
                                                    </span>
                                                    <input type="text" class="form-control" name="title" id="nitelikAdi" placeholder="Nitelik Adı">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label" for="nitelikIcerigi">Nitelik İçeriği</label>
                                                <div class="input-icon">
                                                    <span class="input-icon-addon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 12l5 5l10 -10"></path>
                                                            <path d="M2 12l5 5m5 -5l5 -5"></path>
                                                         </svg>
                                                    </span>
                                                    <input type="text" class="form-control" name="content" id="nitelikIcerigi" placeholder="Nitelik İçeriği">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-xs-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                    Kaydet
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th>Nitelik Adı</th>
                                                    <th>Nitelik İçeriği</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->productProperties as $property)
                                                <tr>
                                                    <td>{{ $property->title }}</td>
                                                    <td>{{ $property->content }}</td>
                                                    <td>
                                                        {{-- <a href="#nitelikDuzenle" data-bs-toggle="modal" data-bs-target="#nitelik-duzenle">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </a> --}}

                                                        <a href="#" class="me-1" data-bs-toggle="modal" data-bs-target="#propertyModal" data-id="{{ $property->id }}" data-title="{{ $property->title }}" data-content="{{ $property->content }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit text-dark" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </a>

                                                        <a href="{{ route('product.property.destroy', $property->id) }}" class="ms-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5">
                                                        <ul class="pagination d-flex justify-content-center align-items-center mx-auto my-2 w-100">
                                                            {{-- {!! $product->productProperties->links() !!} --}}
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
</div>
<!--Nitelik Düzenleme Modalı-->
<div class="modal fade" id="propertyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('product.property.propertyUpdate') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="propertyId">
                <div class="modal-header">
                    <h5 class="modal-title" id="propertyModalLabel">İçeriği Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="subheader mb-1">Nitelik Adı</div>
                    <div class="mb-3">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="8.5" cy="8.5" r="1" fill="currentColor"></circle>
                                    <path d="M4 7v3.859c0 .537 .213 1.052 .593 1.432l8.116 8.116a2.025 2.025 0 0 0 2.864 0l4.834 -4.834a2.025 2.025 0 0 0 0 -2.864l-8.117 -8.116a2.025 2.025 0 0 0 -1.431 -.593h-3.859a3 3 0 0 0 -3 3z"></path>
                                </svg>
                            </span>
                            <input type="text" name="title" class="form-control" id="propertyTitle" placeholder="Nitelik Adı">
                        </div>
                    </div>

                    <div class="subheader mb-1">Nitelik İçeriği</div>
                    <div class="mb-3">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="8.5" cy="8.5" r="1" fill="currentColor"></circle>
                                    <path d="M4 7v3.859c0 .537 .213 1.052 .593 1.432l8.116 8.116a2.025 2.025 0 0 0 2.864 0l4.834 -4.834a2.025 2.025 0 0 0 0 -2.864l-8.117 -8.116a2.025 2.025 0 0 0 -1.431 -.593h-3.859a3 3 0 0 0 -3 3z"></path>
                                </svg>
                            </span>
                            <input type="text" name="content" class="form-control" id="propertyContent" placeholder="İçerik">
                        </div>
                    </div>
                </div>


                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5"></path>
                        </svg>
                        <span class="d-none d-sm-block">Güncelle</span>
                    </button>
                    <button type="reset" class="btn" data-bs-dismiss="modal">Kapat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Nitelik Düzenleme Modalı Sonu-->

<!--Ürün Ekleme Alanı-->
<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasProduct" aria-labelledby="offcanvasProductLabel">
    <div class="offcanvas-header">
        <h2 class="offcanvas-title" id="offcanvasProductLabel">Yeni Ürün/Hizmet Ekle</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label for="product_img" class="form-label">Ürün Resmi</label>
                    <input type="file" name="image" id="product_img" class="form-control" placeholder="Ürün Resmi">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Ürün/Hizmet Adı</label>
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="6" cy="19" r="2"></circle>
                            <circle cx="17" cy="19" r="2"></circle>
                            <path d="M17 17h-11v-14h-2"></path>
                            <path d="M6 5l6.005 .429m7.138 6.573l-.143 .998h-13"></path>
                            <path d="M15 6h6m-3 -3v6"></path>
                        </svg>
                    </span>
                    <input type="text" class="form-control" name="title" placeholder="Ürün/Hizmet Adı">
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="form-label" for="seri_no">Seri No</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                    <path d="M8 13h1v3h-1z"></path>
                                    <path d="M12 13v3"></path>
                                    <path d="M15 13h1v3h-1z"></path>
                                </svg>
                            </span>
                            <input type="text" class="form-control" name="seri_no" placeholder="Seri No">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="barcode_no">Barkod No</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                                    <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                                    <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                                    <rect x="5" y="11" width="1" height="2"></rect>
                                    <line x1="10" y1="11" x2="10" y2="13"></line>
                                    <rect x="14" y="11" width="1" height="2"></rect>
                                    <line x1="19" y1="11" x2="19" y2="13"></line>
                                </svg>
                            </span>
                            <input type="text" class="form-control" name="barcode_no" placeholder="Barkod No">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="form-label">Fiyatı</label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-lira" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 5v15a7 7 0 0 0 7 -7"></path>
                                    <path d="M6 15l8 -4"></path>
                                    <path d="M14 7l-8 4"></path>
                                </svg>
                            </span>
                            <input type="text" class="form-control" name="price" placeholder="Fiyat">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Para Birimi</label>
                        <select name="price_type" id="price_type" class="form-select">
                            <option value="" selected>Seçiniz</option>
                            <option value="₺">₺ Türk Lirası</option>
                            <option value="$">$ Dolar</option>
                            <option value="€">€ Euro</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="unit" class="form-label">Birim</label>
                        <select name="unit" id="unit" class="form-select form-control-sm birim-select">
                            <option value="adet" selected>Adet</option>
                            <option value="ay">Ay</option>
                            <option value="cift">Çift</option>
                            <option value="cuval">Çuval</option>
                            <option value="dakika">Dakika</option>
                            <option value="desilitre">Desilitre</option>
                            <option value="desimetre">Desimetre</option>
                            <option value="file">File</option>
                            <option value="gram">Gram</option>
                            <option value="gun">Gün</option>
                            <option value="hafta">Hafta</option>
                            <option value="kamyon">Kamyon</option>
                            <option value="kilogram">Kilogram</option>
                            <option value="kilometre">Kilometre</option>
                            <option value="koli">Koli</option>
                            <option value="litre">Litre</option>
                            <option value="metre">Metre</option>
                            <option value="metrekare">Metrekare</option>
                            <option value="metrekup">Metreküp</option>
                            <option value="miligram">Miligram</option>
                            <option value="milimetre">Milimetre</option>
                            <option value="paket">Paket</option>
                            <option value="palet">Palet</option>
                            <option value="poset">Poşet</option>
                            <option value="saat">Saat</option>
                            <option value="saniye">Saniye</option>
                            <option value="santimetre">Santimetre</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="0" selected>Seçiniz</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Marka</label>
                <select name="brand_id" id="brand_id" class="form-select">
                    <option value="0" selected>Seçiniz</option>
                    @foreach ($brands as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-xs-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Kaydet
                    </button>
                    <button class="btn" type="reset" data-bs-dismiss="offcanvas">İptal Et</button>
                </div>
            </div>
        </form>
    </div>
    <div class="offcanvas-footer">
        <button class="btn" type="button" data-bs-dismiss="offcanvas">Kapat</button>
    </div>
</div>
<!--Ürün Ekleme Alanı Sonu-->
@endsection


@section('js')
<script>
$(function() {
        $('#propertyModal').on("show.bs.modal", function (e) {
            console.log(e.relatedTarget);
            $("#propertyId").val($(e.relatedTarget).data('id'));
            $("#propertyTitle").val($(e.relatedTarget).data('title'));
            $("#propertyContent").val($(e.relatedTarget).data('content'));

        });

        $('#productModal').on("show.bs.modal", function (e) {
            $("#productId").val($(e.relatedTarget).data('id'));
            $("#productTitle").val($(e.relatedTarget).data('title'));
            $("#productSeriNo").val($(e.relatedTarget).data('seri_no'));
            $("#productBarcodeNo").val($(e.relatedTarget).data('barcode_no'));
            $("#productPrice").val($(e.relatedTarget).data('price'));
            $("#productPriceType").val($(e.relatedTarget).data('price_type'));
            $("#productUnit").val($(e.relatedTarget).data('unit'));
            $("#productCategory").val($(e.relatedTarget).data('category_id'));
            $("#productBrand").val($(e.relatedTarget).data('brand_id'));

        });
    });

</script>
@endsection
