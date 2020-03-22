<template>
    <div class="row">
        <h3>Вибір способів доставки й оплати</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    Доставка в Бровари
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-4">
                    Змінити місто
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <label><input type="radio" name="type_delivery" value="ours"> з наших магазинів</label>
                </div>
                <div class="col-md-4">безкоштовно</div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <label><input type="radio" name="type_delivery" value="Courier"> Кур'єр на вашу адресу</label>
                </div>
                <div class="col-md-4">59 грн</div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <label><input type="radio" name="type_delivery" value="Pickup"> Самовивіз з Нової Пошти</label>
                    <div>
                        Виберіть відповідне відділення: <input type="text" value="">
                    </div>
                </div>
                <div class="col-md-4">60 грн</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <hr>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Оплата
                </div>
                <div class="col-md-9"></div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <label><input type="radio" name="pay_method" value="on_place"> Оплата при отриманні замовлення</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <label><input type="radio" name="pay_method" value="google_pay"> Google Pay </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <label><input type="radio" name="pay_method" value="credit_card"> Оплатити зараз карткою Visa/Mastercard </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        mounted() {
            console.log('CheckOutForm mounted.')
        }
    }
</script>

<style scoped>

</style>
