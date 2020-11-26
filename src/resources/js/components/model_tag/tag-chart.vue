<template>
  <div class="row">

    <network
    ref="network"
    id="network"
    :nodes="fields.nodes"
    :edges="fields.edges"
    >
    <!-- :options="fields.options" -->

    <!-- <pre>
      {{ fields }}
    </pre> -->
    <div class="col">

      <div id="mynetwork"></div>

    </div>

    <!-- :options="options" -->

  </network>

</div>



</template>

<style scoped>
#network {
  width: 600px;
  height: 400px;
  border: 0px solid lightgray;

}


</style>

<script>


import GetDataMixin from '../../GetDataMixin';

export default {
  mixins: [ GetDataMixin ],
  props: ['page_url'],
  data() {
    return {
    }
  },
  mounted() {
  },
  created() {
  },
  methods: {
    reloadData() {
      this.fetchData(this.page_url);
    }

  }

}
</script>
