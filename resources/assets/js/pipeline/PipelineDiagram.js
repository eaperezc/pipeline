
// Including visjs library on this file
window.vis = require('vis');
const Node = require('./Node.js');

/**
 * PipelineDiagram Class
 *
 * This class has all the functionality for the network diagram
 * that we display for the pipeline.
 */
class PipelineDiagram {

    /**
     * Constructor of the class where we will initialize
     * the options and get the data for the pipeline.
     * The element if for the container could be
     * a paramenter here to be more dynamic.
     */
    constructor() {

        this.container = document.getElementById('pipeline-diagram');
        this.nodes = [];
        this.selected_node = null;
        this.id = pipeline_id;

        this.setupOptions();
        this.loadData();
    }

    /**
     * Here we setup all the options for the VisJs network diagram
     * were we see what are the default values and configuration
     */
    setupOptions() {
        this.options = {
            nodes: {
                shape: 'image',
                image: '/images/terminal.png'
            },
            edges: {
                arrows: 'to',
                color: '#aaa',
                smooth: {
                    type: 'continuous',
                    forceDirection: 'none'
                }
            },
            physics: {
                enabled: false
            },
            layout: {
                hierarchical: {
                    direction: 'LR'
                }
            }
        };
    }

    /**
     * Method that will load the structure of the pipeline and
     * will prepare the data object that the visualization
     * library will use to draw all the nodes and edges
     */
    loadData() {

        var self = this;
        this.selected_node = null;

        $.ajax({
            url: '/pipeline/' + self.id + '/structure'
        }).done(function(resp) {

            var auxNodes = [];
            for (i = 0; i < resp.nodes.length; i++) {

                var node = new Node(
                    resp.nodes[i].id,
                    resp.nodes[i].name,
                    resp.nodes[i].hierarchy_level,
                    self,
                    resp.nodes[i].type
                );

                // The first node is the starting one so we show
                // a different icon only for this node.
                if (i == 0) {
                    node.type = 'start';
                }

                self.nodes.push(node);
                auxNodes.push(node.toVisObject());
            }

            var auxConnections = [];
            for (i = 0; i < resp.connections.length; i++) {
                auxConnections.push({
                    from: resp.connections[i].from_node_id,
                    to: resp.connections[i].to_node_id
                });
            }


            var nodes = new vis.DataSet(auxNodes);
            var edges = new vis.DataSet(auxConnections);

            self.data = {
                nodes: nodes,
                edges: edges
            };

            self.initNetwork();
        });
    }

    /**
     * This is the place where we actually create the network diagram
     * with all the data that we prepared. Also some events are
     * added here to be able to select a node and get its data
     */
    initNetwork() {

        // Cached variable for this object
        var self = this;

        // initialize your network!
        this.network = new vis.Network(this.container, this.data, this.options);

        this.network.on('selectNode', function(e) {
            self.OnSelectNode(e);
        });

        this.network.on('release', function(e) {
            self.OnSelectNode(e);
        });
    }

    /**
     * When we select a node on the diagram or when we finish the
     * drag (release event) we want to make sure we have that
     * node information available so we use him later on.
     */
    OnSelectNode(e) {

        e.event.preventDefault();
        this.selected_node = null;

        var selected = this.network.getSelectedNodes();
        var nodes = this.data.nodes.get(selected);

        if (nodes.length > 0) {
            var node = nodes[0];

            $('#node-name').text(node.label);
            this.selected_node = _.find(this.nodes, { 'id': selected[0] });

            $('#details-info').addClass('hidden');
            $('#details-form').removeClass('hidden');
        }
    }

    /**
     * Method to add a new node in the pipeline from a json object
     * @param {json} data The data with the new node info
     */
    addNode(data) {

        var self = this;

        // Create a node from the data
        Node.create(data.name, data.type, this.selected_node.id, this.id,
            // onSuccess
            function() {
                self.loadData();
            }
        );
    }

}

module.exports = PipelineDiagram;
