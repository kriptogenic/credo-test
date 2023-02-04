import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.getGiftApi = async () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content
    let response = await fetch('/gift', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    });
    const data = await response.json()
    return data.data
}

document.addEventListener('alpine:init', () => {
    Alpine.data('giftModal', () => ({
        isModalOpen: false,
        gift: {},
        async getGift() {
            this.gift = await getGiftApi()
            console.log(this.gift)
            this.isModalOpen = true
        },
    }))
})
Alpine.start();


