<template>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <ul class="nav nav-pills ml-6" style="padding-bottom:20px;" role="tablist">
                  <p>Hello</p>
                  <li v-for="recipe_category in recipes_categories">
                    <p>Hello</p>
                  </li>
                </ul>
                <br><br>
                <div  class="clearfix">
                    <div class="row" style="overflow-y: scroll;height: 400px;">
                        <div class="col-md-12" >
                            <div class="row">
                                <div>
                                    <li v-for="recipe in recipes">
                                      {{ recipe.name }} Hello
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="shopping-cart">
                    <cart></cart>
                </div>
            </div>
        </div>
    </div>

</template>

<script>


import OrderList from './OrderList.vue'
import Recipes from './Recipes.vue'
    export default {
        components: { cart: OrderList, recipes: Recipes},
        created () {
          this.getProducts();
          console.log(this.recipes_categories);
        },
        data(){
            return{
                recipes:[],
                recipes_categories: [],
                currentTab: 1
            }
        },
        methods:{
            selectTab(selectedTab) {
                this.currentTab = selectedTab
            },
            getProducts(){
                axios.get('/get_recipes')
                     .then((response)=>{
                       this.recipes_categories = response.data.recipe_categories
                       this.recipes = response.data.recipes
                       // console.log(response.data);
                     })

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style>
@media (min-width: 768px){
    .margin_col {
        margin-right: 58px !important;
    }
    .order_qty{
        padding-left:68px;
    }
    .order_font{
      font-size: 8px;
    }
}
@media (min-width: 1024px){
    .margin_col {
        margin-right: 17px !important;
    }
     .order_qty{
        padding-left:116px;
    }
     .order_font{
      font-size: 13px;
    }
}
</style>
