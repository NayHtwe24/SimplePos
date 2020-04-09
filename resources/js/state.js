export default {
    data: {
        cart: [],
    },
    add(recipe) {

        var found = _.find(this.data.cart, ['id', recipe.id])
        if (typeof found != 'object') {
            this.data.cart.push({
                id: recipe.id,
                name: recipe.name,
                item1: recipe.item1,
                item2: recipe.item2,
                item3: recipe.item3,
                price: recipe.price,
                image: recipe.image,
                qty: 1,
                total_sub_price: 0
            })
        }
    },
    inc(recipe) {
        var found = _.find(this.data.cart, ['id', recipe.id])
        if (typeof found == 'object') {
            var index = _.indexOf(this.data.cart, found)
            this.data.cart[index].qty++;

        }
    },

    dec(recipe) {
        var found = _.find(this.data.cart, ['id', recipe.id])
        if (typeof found == 'object') {
            var index = _.indexOf(this.data.cart, found)
            if (this.data.cart[index].qty == 1) {

                var index = this.data.cart.indexOf(found)
                this.data.cart.splice(index, 1)

            } else {
                this.data.cart[index].qty--
            }
        }

    }
}
