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
    const onAdd = () => {
        const newNode = {
            id: `${nodes.length + 1}`,
            data: {
                label: 'GET'
            },
            position: {
                x: 0,
                y: 100
            },
            width: 100,
            height: 100
        };
        setNodes((ns) => [...ns, newNode]);
    };

    return (
        <AppLayout>
            <Head>
                <title>Laravel - Projeto</title>
            </Head>
            <div className="flex w-screen min-w-max">
                <div className="flex-initial flex flex-col items-center gap-20 font-semibold pt-5 px-5 border-gray-300 border-r w-1/6 bg-white">
                    <span className="text-2xl">Objetos</span>
                    <button className="text-white bg-purple-500 px-10 py-3 rounded-3xl" onClick={onAdd}>GET</button>
                    <button className="text-white bg-sky-500 px-10 py-3 rounded-3xl">POST</button>
                    <button className="text-white bg-indigo-600 px-10 py-3 rounded-3xl">PUT</button>
                    <button className="text-white bg-amber-600 px-10 py-3 rounded-3xl">PATCH</button>
                    <button className="text-white bg-red-700 px-10 py-3 rounded-3xl">DELETE</button>
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
                            <Controls />
                            <MiniMap />
                            <Background variant="dots" gap={12} size={1} />
                        </ReactFlow>
                </div>
                <div className="flex-initial flex flex-col items-center gap-20 font-semibold pt-5 px-5 border-gray-300 border-l w-1/6 bg-white">
                    <span className="text-2xl">Propriedades</span>
                    <div>
                        <span className="text-md">Nome</span>
                        <input className="border border-gray-300 rounded-md" type="text"/>
                    </div>
                    <div>
                        <span className="text-md">Descrição</span>
                        <textarea className="border border-gray-300 rounded-md" type="textarea"/>
                    </div>
                    <div className="flex flex-col items-center gap-10">
                        <span className="text-2xl">Respostas</span>
                        <button className="text-white bg-purple-500 px-10 py-3 rounded-3xl">GET</button>
                        <button className="text-white bg-sky-500 px-10 py-3 rounded-3xl">POST</button>
                    </div>
                </div>
            </div>
        </AppLayout>
    )
}

export default Dashboard
