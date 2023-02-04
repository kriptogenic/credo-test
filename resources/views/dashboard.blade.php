<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="giftModal" x-on:keydown.escape="isModalOpen=false">
        <div class="flex justify-center">
            <button class="
                    text-xl
                    w-64
                    h-64
                    rounded-full
                    text-white
                    bg-gradient-to-r
                    from-purple-500
                    to-pink-500
                    hover:bg-gradient-to-l
                    focus:ring-4
                    focus:outline-none
                    focus:ring-purple-200
                    font-bold
                    text-sm
                    px-5
                    py-2.5
                    text-center"
                type="button"
                x-on:click="getGift()">
                Получить подарок
            </button>
            <div
                class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full flex justify-center items-center"
                role="dialog"
                tabindex="-1"
                x-show="isModalOpen"
                x-cloak
                x-transition
            >
                <div class="relative w-full h-full max-w-2xl md:h-auto" x-on:click.away="isModalOpen = false">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Ваш подарок
                            </h3>
                            <button type="button" x-on:click="isModalOpen = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="defaultModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <template x-if="gift.type === 'item'">
                            <div class="p-6 space-y-6">
                                <p class="text-base leading-relaxed text-gray-500">
                                    Вы выиграли <strong x-text="gift.data"></strong>!
                                </p>
                            </div>
                        </template>
                        <template x-if="gift.type === 'money'">
                            <div class="p-6 space-y-6">
                                <p class="text-base leading-relaxed text-gray-500">
                                    Вы выиграли <strong x-text="gift.data"></strong> сум!
                                </p>
                            </div>
                        </template>
                        <template x-if="gift.type === 'bonus'">
                            <div class="p-6 space-y-6">
                                <p class="text-base leading-relaxed text-gray-500">
                                    Вы выиграли бонус в размере <strong x-text="gift.data"></strong> баллов!
                                </p>
                            </div>
                        </template>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            <button data-modal-hide="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Получить</button>
                            <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отказать</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
