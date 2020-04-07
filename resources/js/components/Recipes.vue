<template>
        <div class="col-md-3 margin_col" style="margin-top:2%;">
            <div class="card recipes_card" style="width:9rem;">
            <div style="font-size:12px" class="card-body recipes_cardbody">
                <div class="text-center">
                    {{ recipe.name }}<br>
                    {{ recipe.price }}ks
                    <span style="font-size:12px" class="qty" v-if="qtyInCart > 0">x {{ qtyInCart }}</span><br>
                    <a href="#"  @click="addToCart" v-if="qtyInCart == 0" style="font-size:12px" class="text-center btn-sm btn btn-primary">Add To Order</a>
                    <div style="font-size:12px" class="clearfix" v-if="qtyInCart != 0">
                        <button class="btn btn-primary btn-sm inc" @click="inc">+</button>
                        <button class="btn btn-primary btn-sm dec" @click="dec">-</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
</template>

<script>

import State from '../state'
import _ from 'lodash'

    export default {
        props: ['recipe'],

        data() {
            return {
                shared: State.data
            }
        },
        methods: {
            addToCart () {
                State.add(this.recipe)

            },
            inc() {
                State.inc(this.recipe)
            },
            dec() {
                State.dec(this.recipe)
            }
        },
        computed: {
            qtyInCart () {
                var found = _.find(this.shared.cart, ['id', this.recipe.id])
                if(typeof found == 'object'){
                    return found.qty
                } else {
                    return 0
                }
            }
        }

    }
</script>

<style>
    .recipes_card .recipes_cardbody {
    padding: 0px;
    padding-bottom:5px;
}
</style>
