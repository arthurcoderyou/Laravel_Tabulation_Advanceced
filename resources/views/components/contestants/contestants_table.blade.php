@guest
    <div class="row">
        @foreach ($contestants as $contestant)
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <img class="card-img" src="{{ asset('upload/'.$contestant->photo) }}" alt="">
                    
                </div>
                
                <div class="card-body">
                    <div class="card-title">
                        <h4>{{ $contestant->name }}</h4>
                        
                    </div>
                        
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endguest