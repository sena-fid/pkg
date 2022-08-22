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

    @if (session()->has('success'))
    <div class="my-3">
        <div class="alert alert-success">{!! session()->get('success') !!}</div>
    </div>
    @endif
    @if (session()->has('error'))
        <div class="my-3">
            <div class="alert alert-danger">{!! session()->get('error') !!}</div>
        </div>
    @endif
    @if ($errors->any())
        <div class="my-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

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
                                <option value="0">Seçiniz...</option>
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
                                            @foreach ($products as $item)
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
                                                        {!! $products->links() !!}
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

<!--Ürün Ekleme Alanı-->
<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasProduct" aria-labelledby="offcanvasProductLabel">
    <div class="offcanvas-header">
        <h2 class="offcanvas-title" id="offcanvasProductLabel">Yeni Ürün/Hizmet Ekle</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label for="image">Resmi Değiştir</label>
                    <input type="file" id="upload-image" name="image" class="form-control">
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
                            <option value="0" selected>Seçiniz</option>
                            @foreach($priceType as $item)
                                <option value="{{ $item->id }}">{{ $item->content }} {{ $item->title }}</option>
                            @endforeach
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

            @if( count($categories)>0 )
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="0" selected>Seçiniz</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            @if(count($brands)>0)
            <div class="mb-3">
                <label class="form-label">Marka</label>
                <select name="brand_id" id="brand_id" class="form-select">
                    <option value="0" selected>Seçiniz</option>
                    @foreach ($brands as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            @endif

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

<!--Toplu Ürün Ekleme Alanı-->
<div class="offcanvas offcanvas-end" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasBulkProduct" aria-labelledby="offcanvasBulkProductLabel">
    <div class="offcanvas-header">
        <h2 class="offcanvas-title" id="offcanvasBulkProductLabel">Toplu Ürün Ekle</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="accordion" id="accordion-bulkProduct">
            <div class="accordion-item border-0 rounded-0">
                <h2 class="accordion-header" id="heading-1">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">Adım 1: Excel Dosyasını İndir</button>
                </h2>
                <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-bulkProduct">
                    <div class="accordion-body pt-2">
                        <p>Toplu ürün yüklemek için örnek Excel dosyasını indirip, ürünleri Excel dosyasındaki yapıda kayıt edin.</p>
                        <p><strong>Örnek Excel Dosyasını İndirmek İçin <a href="{{ asset('assets/file/urun-excel.ods') }}">Tıklayınız.</a></strong></p>
                        <p>Örnek Excel dosyamızı kullanmazsanız ürünleri yükleyemezsiniz. Eğer Excel dosyasına ürünleri yüklediyseniz ikinci adıma geçerek toplu ürün yükleme işlemini gerçekleştirebilirsiniz. </p>
                    </div>
                </div>
            </div>
            <div class="accordion-item border-0 rounded-0">
                <h2 class="accordion-header" id="heading-2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false">Adım 2: Ürün Yükle</button>
                </h2>
                <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#accordion-bulkProduct">
                    <div class="accordion-body pt-0">
                        <form action="{{ route('product.file-import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Dosya Seç</label>
                                <input type="file" class="form-control" name="file" placeholder="Dosya Seçiniz">
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1"></path>
                                            <polyline points="9 15 12 12 15 15"></polyline>
                                            <line x1="12" y1="12" x2="12" y2="21"></line>
                                        </svg>
                                        Yükle
                                    </button>
                                    <button class="btn" type="reset" data-bs-dismiss="offcanvas">İptal Et</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-footer">
        <button class="btn" type="button" data-bs-dismiss="offcanvas">Kapat</button>
    </div>
</div>
<!--Toplu Ürün Ekleme Alanı Sonu-->
@endsection

@section('js')
<script>
    $(function() {
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
