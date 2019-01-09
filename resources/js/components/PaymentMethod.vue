<template>
  <div>
    <div class="form-group">
      <label for class="font-weight-bold">Payment Method</label>
      <div class="list-group">
        <a
          href="#"
          @click="choosePaymentMethod(1)"
          class="list-group-item list-group-item-action"
          :class="isBca ? `active` : ''"
        >BCA (Virtual Account)</a>
        <a
          href="#"
          @click="choosePaymentMethod(2)"
          class="list-group-item list-group-item-action"
          :class="isMandiri ? `active` : ''"
        >Mandiri (Virtual Account)</a>
        <a
          href="#"
          @click="choosePaymentMethod(3)"
          class="list-group-item list-group-item-action"
          :class="isBni ? `active` : ''"
        >BNI (Virtual Account)</a>
      </div>
    </div>

    <input type="hidden" name="payment_method" v-model="paymentMethod">
  </div>
</template>
<script>
export default {
  data() {
    return {
      isBca: false,
      isMandiri: false,
      isBni: false,
      paymentMethod: ``
    };
  },
  mounted() {
    console.log(`payment method component`);
  },
  methods: {
    choosePaymentMethod(method) {
      this.$data.paymentMethod = method;
      switch (method) {
        case 1:
          this.$data.isBca = true;
          this.$data.isMandiri = false;
          this.$data.isBni = false;
          break;
        case 2:
          this.$data.isBca = false;
          this.$data.isMandiri = true;
          this.$data.isBni = false;
          break;
        case 3:
          this.$data.isBca = false;
          this.$data.isMandiri = false;
          this.$data.isBni = true;
          break;
      }
    }
  }
};
</script>