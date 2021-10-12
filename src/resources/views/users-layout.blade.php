<div class="users">
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-2">
                @yield('users')
                <div class="p-2 lg:w-1/2 md:w-1/2 w-full">
                    <a href="@yield('link')">
                        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                            @yield('icon')
                            <div class="flex">
                                <h2 class="text-gray-900 title-font font-medium" style="font-size:20px">@yield('nickname')</h2>   
                            </div>
                            <span>&nbsp;&nbsp;</span>
                            <div style="font-size:20px;display:inline-block;_display:inline;">
                                @yield('age')<br>
                                @yield('gender')<br>
                            </div>
                            <span>&nbsp;&nbsp;</span>
                            <div class="jobs">
                                <div class="flex">
                                    <p class="text-gray-500" style="font-size:20px;">@yield('jobs')</p><br>
                                </div>
                            </div>
                            <span>&nbsp;&nbsp;</span>
                            <div class="tags">
                                @yield('tags')<br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>