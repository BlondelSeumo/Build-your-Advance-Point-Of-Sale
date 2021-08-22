 <div class="bg-default p-3">
     <img title="{{ $item->name }}" src="{{ asset('storage/' . $item->image) }}"
         class="img img-thumbnail logo-img-150wh" alt="image">
     <form action="{{ $routeLink }}" method="post" enctype="multipart/form-data">
         @csrf
         <input type="file" name="image" class="mt-3 form-control @error('image') is-invalid @enderror">
         @error('image')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
         @if (isset($nameId))
             <input type="hidden" name="{{ $nameId }}" value="{{ $item->id }}">
         @endif
         <button type="submit" class="btn btn-sm btn-block mt-1 btn-warning">{{ __('Upload') }}</button>
     </form>
 </div>
 <hr>
