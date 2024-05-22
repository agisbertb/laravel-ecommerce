<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-2">
    <div class="max-w-7xl mx-auto px-6">
        <div class="p-2 rounded-lg bg-gray-900">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 items-center hidden md:inline">
                    <p class="ml-3 text-white cookie-consent__message font-bold">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                </div>
                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto flex space-x-2">
                    <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-bold text-white bg-blue-800 hover:bg-blue-600">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                    <button class="js-cookie-consent-decline cookie-consent__decline cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-white bg-gray-600 hover:bg-gray-500">
                        Decline
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
