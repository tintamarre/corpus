<template>
  <a
  :key="item.id"
  :style="{ color: item.color, fontSize: item.size + '%' }"
  :href="item.href"
  v-tooltip:top="__('app.occurrences') + ': ' + item.occurrence + ' & '  + __('app.children') + ': ' + item.children_count"
  v-text="item.name"
  />

</template>
<style scoped>
a {
  margin-right: 5px;
}
</style>
<script>

export default {
  props: ['item'],

  mounted() {
  },

}
</script>
