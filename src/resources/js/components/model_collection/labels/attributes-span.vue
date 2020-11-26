<template>
  <div>
    <div v-if="!grouped">
      <span v-for="(item, index) in attributes" v-if="(index < max_labels)" class="badge badge-success badge-pill">
        {{ item.attribute }}
      </span>

      <button @click="grouped = !grouped" class="btn btn-sm btn-link small">
      <fa icon="object-group"></fa> {{ __('app.group') }}
      </button>

      <button v-if="(attributes.length > max_labels)"
        @click="max_labels = attributes.length"
        class="btn btn-link btn-sm"
        >
        <fa icon="plus"></fa>
        {{ __('app.show_more') }}
      </button>

      <button v-else @click="max_labels = 15"
      class="btn btn-link btn-sm">
      <fa icon="minus-square"></fa>
      {{ __('app.less') }}
    </button>

    </div>

    <div v-if="grouped">
      <span  v-for="(items,index) in groupedAttributes(attributes)" class="badge badge-pill badge-success">
        {{index}}
        <small class="badge badge-pill badge-light">{{items.length}}
        </small>
      </span>

        <button @click="grouped = !grouped" class="btn btn-sm btn-link small">
          <fa icon="object-ungroup"></fa> {{ __('app.ungroup') }}
        </button>
      </div>
      <!-- <ul>
      <li v-for="model in items">
      {{model}}
    </li>
  </ul> -->





</div>
</template>

<style>

</style>

<script>

export default {
  props: ['attributes'],

  mounted() {
  },
  data() {
    return {
      'max_labels': 10,
      'grouped': false
    }
  },
  methods: {
    groupedAttributes(collection) {
      var items={};
      collection.forEach((item)=>{
        if(items[item.attribute]==undefined){
          items[item.attribute]=[];
          items[item.attribute].push(item.model)
        }
        else{
          items[item.attribute].push(item.model);

        }
      });
      return items;
    }
  },
}

</script>
