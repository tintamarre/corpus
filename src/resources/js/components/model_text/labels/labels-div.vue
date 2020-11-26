<template>
  <table class="table table-borderless table-sm">
    <tr v-for="(label, index) in labels">
      <td class="text-right">
        <a :href="label.links.self" class="badge badge-primary">
          <fa icon="layer-group"></fa>
          {{ label.name }}
        </a>
      </td>
      <td>
        <span class="badge badge-pill badge-success">
          {{ label.attribute }}
        </span>
      </td>
    </tr>
  </table>
</template>

<script>

export default {
  props: ['labels'],

  mounted() {
  },

}
</script>
