<template>
  <div>
    <div class="form-group">
      <label for="topup">Top Up</label>
      <select
        name="topup"
        v-model="chooseTopup"
        class="form-control"
        id="select__topup"
        @change="changeChooseTopup"
      >
        <option value>Pilih Topup</option>
        <option value="50000">50.000</option>
        <option value="100000">100.000</option>
        <option value="300000">300.000</option>
        <option value="500000">500.000</option>
        <option value="1000000">1.000.000</option>
        <option value="custom">Custom</option>
      </select>
    </div>
    <div class="form-group" v-if="chooseTopup === `custom`">
      <label for="topup-custom">Custom</label>
      <input
        type="number"
        name="topup"
        class="form-control"
        v-model="chooseTopupCustom"
        @keyup="changeTopupIndicator"
      >
    </div>
    <div class="form-group">
      <p>Topup : {{ parseInt(topup) }}</p>
      <!-- <p class="font-weight-bold">{{ total }}</p> -->
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      chooseTopupCustom: 0,
      topup: 0,
      chooseTopup: ``,
      total: 0
    };
  },
  mounted() {
    console.log(`mounted topup components`);
  },

  methods: {
    changeChooseTopup() {
      console.log(`choose ${this.$data.chooseTopup}`);
      this.$data.topup =
        this.$data.chooseTopup != `custom` ? this.$data.chooseTopup : 0;

      // if (this.$data.chooseTopup == `custom`) {
      //   this.$data.total += parseInt(this.$data.chooseTopupCustom);
      // } else {
      //   this.$data.total += parseInt(this.$data.chooseTopup);
      // }
    },
    changeTopupIndicator() {
      if (this.$data.chooseTopupCustom < 0) {
        this.$data.chooseTopupCustom = 0;
        this.$data.topup = 0;
      } else {
        this.$data.topup = this.$data.chooseTopupCustom || 0;
      }

      // if (this.$data.chooseTopup == `custom`) {
      //   this.$data.total += parseInt(this.$data.chooseTopupCustom);
      // } else {
      //   this.$data.total += parseInt(this.$data.chooseTopup);
      // }
    }
  }
};
</script>