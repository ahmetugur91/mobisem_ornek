@extends("layouts.app")
@section("title","Lokasyonlar")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lokasyonlar</div>
                    <div class="card-body">
                        <div class="form-group">
                            <a href="{{route("location.create")}}" class="btn btn-primary">Yeni Lokasyon</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-condensed">
                                <thead>
                                <tr class="bg-light">
                                    <th>Üye</th>
                                    <th>Lokasyon Adı</th>
                                    <th>Şehir</th>
                                    <th>İlçe</th>
                                    <th>İşlem</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($locations as $location)
                                    <tr>
                                        <td>{{$location->user->name}}</td>
                                        <td>{{$location->name}}</td>
                                        <td>{{$location->city}}</td>
                                        <td>{{$location->district}}</td>
                                        <td>
                                            <div class="btn-group">


                                                <a href="{{route("location.show",$location)}}" class="btn btn-info btn-sm text-white"><i class="icon icon-map-marker"></i> İncele</a>


                                                @can("update",$location)
                                                    <a href="{{route("location.edit",$location)}}" class="btn btn-primary btn-sm text-white"><i class="icon icon-edit"></i> Düzenle</a>
                                                @endcan

                                                @can("delete",$location)
                                                    <button class="btn btn-danger btn-sm text-white"
                                                            onclick="if(confirm('Emin misiniz?')) { event.preventDefault();document.getElementById('delete_location_{{$location->id}}').submit();} else return false;">
                                                        <i class="icon icon-trash"></i> Sil
                                                    </button>

                                                    <form action="{{route("location.destroy",$location)}}" method="POST" id="delete_location_{{$location->id}}">
                                                        @csrf
                                                        {{method_field("DELETE")}}
                                                    </form>
                                                @endcan

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$locations->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection