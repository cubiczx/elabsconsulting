<template>
    <div class="container item-container">
        <div class="row">
            <div class="col-12">
                <h1>Elabs Consulting Test</h1>
            </div>
            <div class="col-6 item-info">
                <div class="container item-info__details">
                    <h2>Item Details</h2>
                    <div class="col-12">
                        <div class="col-6">
                            <figure>
                                <img :src="item.image" class="figure-img img-fluid rounded" :alt="item.brand + ' ' + item.model + ' ' + item.color + ' ' + item.material" />
                                <figcaption class="figure-caption">{{ item.brand + ' ' + item.model }}</figcaption>
                            </figure>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    {{ item.brand + ' ' + item.model }}
                                </div>
                                <div class="card-body">
                                    <div class="card-text">
                                        {{ item.color }}
                                    </div>
                                    <div class="card-text">
                                        {{ item.material }}
                                    </div>
                                    <div class="card-text">
                                        {{ item.price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="container item-info__summary">
                    <h2>Summary</h2>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                Price
                            </div>
                            <div class="col-8">
                                {{ item.price }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                Taxes
                            </div>
                            <div class="col-8">
                                {{ item.taxes }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 bold">
                                Total:
                            </div>
                            <div class="col-8">
                                {{ item.finalPrice }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CheckoutComponent',
        data() {
            return {
                itemId: 1,
                item: [],
            }
        },
        mounted() {
            this.loadItem();
        },
        methods: {
            loadItem() {
                Promise.all([
                    this.getItem(this.itemId),
                    this.getCalculatePrices(this.itemId),
                ])
                    .then(([item, calculatePrices]) => {
                        this.item = item;
                        this.item.finalPrice = calculatePrices.finalPrice;
                        this.item.taxes = calculatePrices.taxes;
                    })
                    .catch((error) => {
                        console.error(error);
                        console.log('Something bad happened when retrieving the item data.');
                    });
            },
            getItem(id) {
                return axios.get(`http://prueba-elabsconsulting.com:8184/api/items/${id}`)
                    .then(({ data: response }) => {
                        if (response.data) {
                            console.log(`Item ${id} successfully retrieved.`);
                            return Promise.resolve(response.data);
                        }
                        return Promise.reject(new Error(`Something happened trying to retrieve item ${id}`));
                    });
            },
            getCalculatePrices(id) {
                return axios.get(`http://prueba-elabsconsulting.com:8184/api/items/${id}/calculatePrices`)
                    .then(({ data: response }) => {
                        console.log('getCalculatePrices', response)
                        if (response.data) {
                            console.log(`Item calculate prices ${id} successfully retrieved.`);
                            return Promise.resolve(response.data);
                        }
                        return Promise.reject(new Error(`Something happened trying to retrieve item ${id} calculate prices`));
                    });
            }
        }
    }
</script>
