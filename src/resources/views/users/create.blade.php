<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="post" action="{{ route('mypage.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="-m-2">

							<!-- ニックネーム -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="nickname" class="leading-7 text-sm text-gray-600">ニックネーム　<span
                                            class="text-red-600">※必須</span></label>
                                    <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>

							<!-- アイコン画像 -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="icon_image" class="leading-7 text-sm text-gray-600">アイコン画像<span
                                            class="text-red-600">※必須</span></label>
                                    <input type="file" id="icon_image" name="icon_image" value="{{ old('icon_image') }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>

							<!-- 年齢 -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="age" class="leading-7 text-sm text-gray-600">年齢　<span
                                            class="text-red-600">※必須</span></label>
                                    <input type="number" id="age" name="age" value="{{ old('age') }}" required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <span class="text-sm">0〜99の範囲で入力してください</span>
                                </div>
                            </div>

							<!-- 性別 -->
                            <div class="p-2 w-1/2 mx-auto">
                                <label for="gender" class="leading-7 text-sm text-gray-600">性別</label>
                                <div class="relative flex justify-around">
                                    <div><input type="radio" name="gender" value="1" class="mr-2" checked>男性</div>
                                    <div><input type="radio" name="gender" value="2" class="mr-2">女性</div>
                                </div>
                            </div>

							<!-- 自己紹介 -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="introduction" class="leading-7 text-sm text-gray-600">自己紹介　<span
                                            class="text-red-600">※必須</span></label>
                                    <textarea id="introduction" name="introduction" rows="10" required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('introduction') }}</textarea>
                                </div>
                            </div>

							<!-- github -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="github_url" class="leading-7 text-sm text-gray-600">Github_URL 　<span
                                            class="text-red-600">※必須</span></label>
                                    <input type="text" id="github_url" name="github_url" value="{{ old('git_url') }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>

							<!-- facebook -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="facebook_url" class="leading-7 text-sm text-gray-600">Facebook_URL
                                        　<span class="text-red-600">※必須</span></label>
                                    <input type="text" id="facebook_url" name="facebook_url"
                                        value="{{ old('facebook_url') }}" required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>

							<!-- qiita -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="qiita_url" class="leading-7 text-sm text-gray-600">qiita_URL 　<span
                                            class="text-red-600">※必須</span></label>
                                    <input type="text" id="qiita_url" name="qiita_url" value="{{ old('qiita_url') }}"
                                        required
                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>

							<!-- 職業 -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="jobs" class="leading-7 text-sm text-gray-600">職業　<span
                                            class="text-red-600">※必須</span></label>
                                    @foreach($all_jobs as $all_job)
                                    <div>
                                        <input type="checkbox" id="jobs" name="job_ids[]"
                                            value="{{ $all_job->id }}">
                                        <label for="{{ $all_job->name }}">{{ $all_job->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

							<!-- スキル -->
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <label for="skill" class="leading-7 text-sm text-gray-600">スキル　<span
                                            class="text-red-600">※必須</span></label>
                                    @foreach($all_tags as $all_tag)
                                    <div>
                                        <input type="checkbox" id="tags" name="tag_ids[]"
                                            value="{{ $all_tag->id }}">
                                        <label for="{{ $all_tag->name }}">{{ $all_tag->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

							<!-- ボタン -->
                            <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button" onclick="location.href='{{ route('mypage.index')}}'"
                                    class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                <button type="submit"
                                    class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>