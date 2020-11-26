<template>
  <div>
    {{ percent }}
  </div>
</template>

<style>
/* div {
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid red;
  height: 50px;
  width: 50px;
  position: fixed;
  right: 25px;
} */
</style>

<script>
// import GetDataMixin from '../../GetDataMixin';

export default {
  // props: ['page_url'],
  // mixins: [ GetDataMixin ],

  mounted() {
  },
  data() {
    return {

      percent: 0,
      scrollEvent: null,
      progressStartMarker: null,
      progressEndMarker: null,

    }
  }
}
</script>
