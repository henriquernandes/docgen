import AppLayout from '@/components/Layouts/AppLayout'
import Head from 'next/head'
import ReactFlow, {addEdge, Background, Controls, MiniMap, useEdgesState, useNodesState} from "reactflow";
import {useCallback} from "react";
import 'reactflow/dist/style.css';

const initialNodes = [
    { id: '1', position: { x: 0, y: 0 }, data: { label: '1' } },
    { id: '2', position: { x: 0, y: 100 }, data: { label: '2' } },
];
const initialEdges = [{ id: 'e1-2', source: '1', target: '2' }];

const Dashboard = () => {

    const [nodes, setNodes, onNodesChange] = useNodesState(initialNodes);
    const [edges, setEdges, onEdgesChange] = useEdgesState(initialEdges);

    const onConnect = useCallback((params) => setEdges((eds) => addEdge(params, eds)), [setEdges]);

    return (
        <AppLayout>
            <Head>
                <title>Laravel - Projeto</title>
            </Head>
            <div className="flex min-w-max h-[100%]">
                <div className="flex-initial border-gray-300 border-r w-1/6 bg-white">
                    a
                </div>
                <div className="w-full">
                        <ReactFlow
                            nodes={nodes}
                            edges={edges}
                            onNodesChange={onNodesChange}
                            onEdgesChange={onEdgesChange}
                            onConnect={onConnect}
                            fitView
                        >
                            {/*<Controls />*/}
                            {/*<MiniMap />*/}
                            <Background variant="dots" gap={12} size={1} />
                        </ReactFlow>
                </div>
                <div className=" flex-initial w-1/6 bg-white">
                    a
                </div>
            </div>
        </AppLayout>
    )
}

export default Dashboard
