<template>
  <div class="table-responsive-sm">
    <table class="table table-sm">
      <tr v-for="item in stats" :key="item.id" class="">
        <th>{{ item.trans }}</th>
        <td class="text-right">{{ item.value }}</td>
      </tr>
    </table>
  </div>
</template>

<style scoped>
tr {
  color: #666;
}
</style>

<script>
export default {
  props: ["stats"],
};
</script>
