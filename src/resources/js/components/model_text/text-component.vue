<template>
  <div>
    <div id="progress-marker-start" />

    <div class="row">
      <div class="col-lg-9 col-md-12 col-sm-12">
        <text-abstract :text="text" :links="text.links" />

        <text-labels :text="text" :labels="text.relationships.labels" />

        <text-tagscloud :tagscloud="text.relationships.tagscloud" />
      </div>

      <div class="col-lg-3 col-md-12 col-sm-12">
        <h5 class="card-title">
          {{ __("app.computed") }}
        </h5>

        <div class="card-text">
          <text-stats :stats="text.relationships.stats" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <hr />
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 col-md-2 col-lg-2">
        <h5 class="text-right text-muted">
          {{ __("app.text").toUpperCase() }}
        </h5>
      </div>
      <div class="col-sm-8 col-md-8 col-lg-8"></div>

      <div class="col-sm-2 col-md-2 col-lg-2">
        <!-- <div class="custom-control custom-switch">
        <input @click="onlyMyTags()" v-model="onlyMyTags" type="checkbox" class="custom-control-input" id="switchMineTags">
        <label class="custom-control-label" for="switchMineTags">{{ __('app.show_only_mine') }}</label>
      </div> -->
      </div>
    </div>

    <div id="progress-indicator">
      <div id="progress" v-if="percent >= 5 && percent <= 99">
        <pre>{{ percent }} %</pre>
      </div>
      <div id="done" v-if="percent > 99" class="text-success">
        <pre>{{ __("app.done") }}</pre>
      </div>
    </div>

    <div
      v-for="(segment, segment_index) in text.relationships.segments"
      :key="segment.id"
      ref="text"
    >
      <text-segments
        :segment="segment"
        :text="text"
        :segment_index="segment_index"
        v-on="$listeners"
      />
    </div>

    <div class="row" v-if="text.relationships.segments.length == 0">
      <div class="col text-center">
        <button @click="add_new = !add_new" class="btn btn-success btn-sm">
          <fa icon="plus"></fa>
          {{ __("app.add_new") }} {{ __("app.text") }}
        </button>
        <div class="form-group" v-if="add_new">
          <div
            class="alert alert-primary"
            role="alert"
            v-html="__('app.info_how_to_segment_text')"
          ></div>

          <form class="" :action="text.links.store_segment" method="post">
            <input
              type="hidden"
              name="_token"
              id="csrf-token"
              :value="csrfToken"
            />

            <textarea name="text" rows="20" cols="80" class="form-control">
            </textarea>

            <button type="submit" class="btn btn-success pull-right">
              <fa icon="save"></fa>
              {{ __("app.insert") }}
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div id="progress-marker-end" />
    </div>
  </div>
</template>


<style scoped>
#progress-marker-start,
#progress-marker-end {
  border: 0px solid;
}

#progress-indicator {
  visibility: hidden;
}
#progress {
  position: fixed;
  left: 25px;
  bottom: 5px;
  color: #666;
  padding: 5px 10px 5px 10px;
  border: 1px solid #ccc;
  border-radius: 10px;
}

#done {
  position: fixed;
  left: 25px;
  bottom: 15px;
}
</style>


<script>
export default {
  props: ["text"],
  data() {
    return {
      add_new: false,
      csrfToken: "",
      progressStartMarker: null,
      progressEndMarker: null,
      percent: null,
    };
  },
  mounted() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    this.progressStartMarker = document.querySelector("#progress-marker-start");
    this.progressEndMarker = document.querySelector("#progress-marker-end");

    if (!this.progressStartMarker || !this.progressEndMarker) {
      throw Error("Progress markers not found");
    }
    window.addEventListener("scroll", () => {
      this.getScrollPercentage(
        this.progressStartMarker,
        this.progressEndMarker
      );
    });
  },

  methods: {
    getScrollPercentage(startMarker, endMarker) {
      const offsetFromTop = this.getPosRelativeToBody(startMarker);
      const total =
        this.getPosRelativeToBody(endMarker) -
        offsetFromTop -
        window.innerHeight;
      const progress = ((window.scrollY - offsetFromTop) / total) * 100;
      this.percent = Math.round(progress % 100);
    },
    getPosRelativeToBody(el) {
      return Math.abs(
        document.documentElement.getBoundingClientRect().top -
          el.getBoundingClientRect().top
      );
    },
  },
};
</script>
