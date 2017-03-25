import NodeDetails from './components/NodeDetails.vue';

window.diagram = new Vue({
    el: '#pipeline-diagram-app',
    components: {
        'node-details': NodeDetails
    },
    data: {
        node: null
    },
    methods: {
        changeNode(node) {
            this.node = node;
        }
    }
});
