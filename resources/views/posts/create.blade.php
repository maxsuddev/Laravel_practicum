<x-layouts.main>
    <x-slot:title>
        Create Page
</x-slot:title>

    <x-layouts.page>
Create Page
</x-layouts.page>
    <!-- Create Start -->
    <div class="container-fluid py-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="control-group mb-3">
                                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                                    <input type="text" class="form-control p-4" name="title" value="{{old('title')}}" placeholder="Add title"  />
                                    @error('title')
                                    <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                            <div class="form-group">
                                <select class="form-control mb-3" name="category_id">
                                    <option style="color: white">Choose Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                </select>
                                        @error('category_id')
                                        <p class="help-block text-danger">{{$message}}</p>
                                @enderror

                            </div>
                            <div class="form-group">
                                <select class="form-control mb-3" name="tags[]" multiple>
                                    <option style="color: white" value="{{null}}">Choose Tag</option>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="control-group mb-3">
                                    <input type="file" class="form-control p-4" name="photo"/>
                                    @error('photo')
                                    <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                            <div class="control-group mb-3">
                                <textarea  class="form-control p-4" rows="2" name="short_content" placeholder="Add short content"  ></textarea>
                                @error('short_content')
                                <p class="help-block text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <textarea class="form-control p-4" rows="3" name="full_content" placeholder="Add content" >{{old('content')}}</textarea>
                                @error('full_content')
                                <p class="help-block text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Create End -->
</x-layouts.main>
