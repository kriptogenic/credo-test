import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('giftModal', () => ({
        isModalOpen: false,
        gift: {},
        address: '',
        convert: false,
        async getGift() {
            let response = await fetch('/gift', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                }
            });
            const data = await response.json()
            this.gift = data.data
            this.address = ''
            this.convert = false
            this.isModalOpen = true
        },
        async acceptGift() {
            if (this.address === '') {
                alert('Введите адрес')
                return
            }
            await fetch('/gift/' + this.gift.id, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
                body: JSON.stringify({
                    address: this.address,
                    convert: this.convert
                })
            })
            alert('Приз успешно потдвержден')
            this.isModalOpen = false
        },
        async declineGift() {
            await fetch('/gift/' + this.gift.id, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
            })
            this.isModalOpen = false
        },
        getCsrfToken: () => document.querySelector('meta[name="csrf-token"]').content,
    }))
})
Alpine.start();


