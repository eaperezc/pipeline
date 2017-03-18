
// Including visjs library on this file
window.vis = require('vis');

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

        this.container = document.getElementById('mynetwork');

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

        $.ajax({
            url: '/pipeline/' + pipeline_id
        }).done(function(resp) {

            var auxNodes = [];
            for (i = 0; i < resp.nodes.length; i++) {
                auxNodes.push({
                    id: resp.nodes[i].id,
                    label: resp.nodes[i].name,
                    level: resp.nodes[i].hierarchy_level
                });
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

        // Events
        this.network.on('oncontext', function(e) {
            e.event.preventDefault();
            node = this.network.getNodeAt(e.pointer.DOM);

            if (node) {
                this.network.selectNodes([ node ]);

                window.location = "/nodes/create/" + node;
            }

        });

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
        selected = this.network.getSelectedNodes();
        nodes = this.data.nodes.get(selected);
        if (nodes.length > 0) {
            var node = nodes[0];
            $('#node-name').text(node.label);
        }

    }

}


/**
 * This is the starting point where we will initialize the network diagram
 * but maybe later we could move this to the app.js so this class stays
 * clean and only has the declaration of the Diagram Class.
 */
$( document ).ready(function() {
    var diagram = new PipelineDiagram();
});
