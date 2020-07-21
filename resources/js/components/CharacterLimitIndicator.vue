<template>
  <div class="mr-6" v-if="body.length > 0">
    <span v-if="reachErrorLimit" class="text-sm text-red-600">
      {{
      characterLeft
      }}
    </span>
    <div v-else>
      <svg viewBox="0 0 36 36" class="circular-chart h-8 w-8">
        <path
          class="circle-bg"
          d="M18 2.0845
                a 15.9155 15.9155 0 0 1 0 31.831
                a 15.9155 15.9155 0 0 1 0 -31.831"
        />
        <path
          fill="currentColor"
          class="circle"
          :stroke="indicatorColor"
          :stroke-dasharray="characterLeftPercentage + ' 100'"
          d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
        />
        <text
          x="50%"
          y="50%"
          text-anchor="middle"
          stroke="#A0AEC0"
          dy=".4em"
          stroke-width=".5px"
          v-if="reachWarningLimit"
        >{{ characterLeft }}</text>
      </svg>
    </div>
  </div>
</template>

<script>
export default {
  props: ["body"],
  data() {
    return {
      limit: 255
    };
  },
  computed: {
    characterLeftPercentage() {
      return ((this.limit - this.body.length) * (100 / this.limit)).toFixed(0);
    },

    characterLeft() {
      return this.limit - this.body.length;
    },

    limitExceed() {
      return this.body.length > this.limit;
    },
    reachWarningLimit() {
      return this.body.length > this.limit - 21;
    },

    reachErrorLimit() {
      return this.body.length > this.limit + 10;
    },

    reachInitailErrorLimit() {
      return (
        this.body.length > this.limit && this.body.length <= this.limit + 10
      );
    },
    indicatorColor() {
      if (this.reachInitailErrorLimit) {
        return "#E53E3E";
      }

      if (this.reachWarningLimit) {
        return "#DD6B20";
      }

      return "#4299e1";
    }
  }
};
</script>


<style scoped>
.circular-chart {
  display: block;
  margin: 10px auto;
}

.circle {
  fill: none;
  stroke-width: 4;
  stroke-linecap: round;
  animation: progress 1s ease-out forwards;
}
.circle-bg {
  fill: none;
  stroke: #e2e8f0;
  stroke-width: 5;
}

@keyframes progress {
  0% {
    stroke-dasharray: 0 100;
  }
}
.percentage {
  fill: #666;
  text-anchor: middle;
}
</style>