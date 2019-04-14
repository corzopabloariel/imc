<section class="wrapper-videos py-5">
    <div class="container">
        <div class="row py-3">
            <div class="col-12">
                <h3 class="title">Videos</h3>
            </div>
        </div>
        <div class="row">
            @foreach ($contenido as $v)
                <div class="col-md-4 col-12 my-3">
                    <iframe class="w-100" src="https://www.youtube.com/embed/{{$v['video']}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <p class="mb-0">{{$v["titulo"]}}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>