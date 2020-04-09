<template>
  <div class="container">
      <div class="row">
          <div class="col-md-7">
              <ul class="nav nav-pills ml-6" style="padding-bottom:20px;" role="tablist">
                  <li class="nav-item" v-for="recipe_category in recipes.recipe_categories" @click="selectTab(recipe_category.id)">
                      <a :class="{ 'nav-link active' : currentTab == recipe_category.id}" class="nav-link" href="#" aria-controls="pills-home" aria-selected="true">{{ recipe_category.name }} </a>
                  </li>
              </ul>
              <br><br>
              <div  class="clearfix">
                  <div class="row" style="overflow-y: scroll;height: 400px;">
                      <div class="col-md-12" >
                          <div class="row">
                              <recipes v-for="recipe in recipes.recipes[currentTab]" :recipe="recipe" :key="recipe.id"></recipes>
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


import OrderListCart from './OrderList.vue'
import Recipes from './Recipes.vue'
    export default {
        components: { cart: OrderListCart, recipes: Recipes},
        created () {
            axios.get("get_recipes").
            then(({ data }) => (
                this.recipes = data,
                console.log(data.recipes)
            ));
        },
        data(){
            return{
                recipes: {},
                currentTab: 1
            }
        },
        methods:{
            selectTab(selectedTab) {
                this.currentTab = selectedTab
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
