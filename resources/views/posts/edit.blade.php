<x-layouts.main>
    <x-slot:title>
Show Page
</x-slot:title>

    <x-layouts.page>
Show Page
</x-layouts.page>
    <!-- Update Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="{{route('posts.update',['post' => $post->id])}}" method="POST"
                              onsubmit="return confirm('Are you sure you want to update this post?')"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="control-group mb-3">
                                <input type="text" class="form-control p-4" name="title" value="{{$post->title}}" placeholder="Add title"  />
                                @error('title')
                                <p class="help-block text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <input type="file" class="form-control p-4" name="photo"/>
                                @error('photo')
                                <p class="help-block text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="control-group mb-3">
                                <textarea  class="form-control p-4" rows="2" name="short_content" placeholder="{{$post->short_content}}"  ></textarea>
                                @error('short_content')
                                <p class="help-block text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <textarea class="form-control p-4" rows="3" name="full_content" placeholder="{{$post->content}}" ></textarea>
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
    <!-- Update End -->
</x-layouts.main>
