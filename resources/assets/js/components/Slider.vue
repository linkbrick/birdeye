<template>
    <div :id="sliderId" class="slider"></div>
</template>

<script>
    export default {
        props: ['sliderValue', 'sliderMin', 'sliderMax', 'sliderStep'],
        data(){
            return {
                sliderId: this.uuid4(),
                sliderElement: '',
            }
        },
        mounted() {
            var slider = document.getElementById(this.sliderId);
            this.sliderElement = slider;
            noUiSlider.create(slider, {
                start: this.sliderValue,
                step: this.sliderStep,
                range: {
                    'min': [this.sliderMin],
                    'max': [this.sliderMax]
                },
            })
            
            slider.noUiSlider.on('update', function (value) {
                this.$emit('updatevalue', value[0]);
            }.bind(this));

            slider.noUiSlider.on('end', function (value) {
                this.$emit('end', value[0]);
            }.bind(this));
        },
        methods: {
            uuid4: function () {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                    var r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8)
                    return v.toString(16)
                })
            },
            refreshSlider: function (val) {
                this.sliderElement.noUiSlider.set(this.sliderValue);
            },
        },
    }
</script>