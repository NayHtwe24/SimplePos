<template>
    <div class = "cart">
        <p class="cart-title">Order list</p>
        <p class="cart-empty" v-if="total == 0">Your order is Empty!</p>
        <div class="items" v-else>
            <div class="box" v-for="item in items">
                <div style="font-size:14px" class="item-details">
                    {{ item.name }}<br>
                    <span v-if="item.item1">{{ item.item1 }}<br /></span>
                    <span v-if="item.item2">{{ item.item2 }}<br /></span>
                    <span v-if="item.item3">{{ item.item3 }}<br /></span>
                    <a href="#" class="badge badge-secondary">x{{ item.qty }}</a> {{ item.qty * item.price }}ks
                    <br><hr>
                </div><br><br><br>
            </div><br>
        </div>
        <div class="cart-total">
          <span>Discount</span>
          <input type="number"  name="discount" value='0' style="text-align: center;" v-model="discount">
          <br>
          <br>
          <a class="btn btn-primary right" @click="editBill"><i class="fa fa-check" aria-hidden="true">confirm</i></a>
        </div>
        <div class="cart-total">
            <span>Discount</span>
            <span class="right">{{ discount }}ks</span>
        </div>
        <div class="cart-total">
            <span>Total</span>
            <span class="right">{{ total }}ks</span>
        </div>
        <div class="cart-total">
            <span>Final Price</span>
            <span class="right">{{ final_total }}ks</span>
        </div>
        <div>
            <button class="btn btn-success" btn-sm @click="order()">Paid</button>
        </div>

    </div>
</template>

<script>

    import State from '../state'
    import _ from 'lodash'

    export default {
        data() {
            return {
                items: State.data.cart,
                discount:0,
                final_total: 0
            }
        },
        methods:{
            order() {
                axios.post("recipe_order",{ orderlists: this.items ,discount: this.discount,before_total: this.total,final_total: this.final_total}).
                then(({ data }) => (
                    console.log(data),
                    location.reload()
                ));
            },
            editBill(){
                this.final_total = (parseInt(this.total) - parseInt(this.discount))
            }
        },
        computed: {
            total(){
                return _.sumBy(this.items, function(item){
                    return (item.price * item.qty)
                })

            }
        }
    }
</script>

<style>
    .cart-title {
        margin: 0.5em 0 0 0;
        font-weight: bold;
        width: 100%;
        text-transform: uppercase;
        text-align: center;
        padding: 0.45em;
        background: #35495E;
        color: #fff;
    }
    .cart-empty {
        text-align: center;
        margin: 4em 0 0 0;
        min-height: 300px;
    }
    .cart-total {
        background: #F1F1F1;
        margin: 0;
        margin-top: 30%;
        padding: 0.75em;
        border-top: 1px solid #cebebe;

    }

    .box {
        padding: 3.75em 0.5em 29px;
        /* border-top: 1px solid #cebebe; */
    }
    .right {
        float: right;
    }
    .item-image {
        float: left;
        width: 40%;
    }
    .item-details {
        float: left;
        padding-left: 0.75em;
    }
</style>
