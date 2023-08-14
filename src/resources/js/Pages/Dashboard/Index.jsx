import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router, useForm } from "@inertiajs/react";
import ReactFlow, {
    addEdge,
    Background,
    Controls,
    MiniMap,
    useEdgesState,
    useNodesState,
} from "reactflow";
import { useCallback, useEffect, useState } from "react";
import "reactflow/dist/style.css";

const initialNodes = [
    { id: "1", position: { x: 0, y: 0 }, data: { label: "1" } },
    { id: "2", position: { x: 0, y: 100 }, data: { label: "2" } },
];
const initialEdges = [{ id: "e1-2", source: "1", target: "2" }];

export default function Dashboard({ auth, rotas, projeto_id }) {
    const [nodes, setNodes, onNodesChange] = useNodesState(initialNodes);
    const [edges, setEdges, onEdgesChange] = useEdgesState(initialEdges);
    const [selectedNode, setSelectedNode] = useState(null);

    const {
        data,
        setData,
        delete: destroy,
        put,
        reset,
        errors,
    } = useForm({
        titulo: "",
        descricao: "",
        rota: "",
        projeto_id: projeto_id,
    });

    const onConnect = useCallback(
        (params) => setEdges((eds) => addEdge(params, eds)),
        [setEdges]
    );
    const onAdd = (method) => {
        const newNode = {
            id: `${nodes.length + 1}`,
            data: {
                label: method,
                titulo: method,
                descricao: `Nova rota com método ${method}`,
                rota: "/nova-rota",
                projeto_id: projeto_id,
            },
            position: {
                x: 0,
                y: 150,
            },
            width: 100,
            height: 100,
        };

        setNodes((ns) => [...ns, newNode]);

        router.post("/rotas", {
            method: method,
            titulo: method,
            descricao: `Nova rota com método ${method}`,
            rota: "/nova-rota",
            projeto_id: projeto_id,
        });
    };

    const handleChange = (data, prop) => {
        const {
            target: { value },
        } = data;
        setSelectedNode({
            ...selectedNode,
            data: {
                ...selectedNode.data,
                [prop]: value,
            },
        });

        setData({
            ...selectedNode.data,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        router.put(`/rotas/${data.id}`, {
            ...data,
            titulo: data.label,
        });
    };

    useEffect(() => {
        setNodes((nds) =>
            nds.map((node) => {
                if (node.id === selectedNode?.id) {
                    node.data = {
                        ...node.data,
                        ...selectedNode.data,
                    };

                    setData({
                        ...selectedNode.data,
                    });
                }
                return node;
            })
        );
    }, [selectedNode, setNodes]);

    useEffect(() => {
        setNodes((nds) =>
            rotas.map((rota, i) => {
                console.log(i * 150);
                const node = {
                    ...nds,
                    id: rota.id,
                    data: {
                        label: rota.titulo,
                        ...rota,
                    },
                    position: {
                        x: i * 200,
                        y: 0,
                    },
                    width: 100,
                    height: 100,
                };
                return node;
            })
        );
    }, [rotas]);

    return (
        <AuthenticatedLayout user={auth}>
            <Head title="Dashboard" />
            <div className="flex flex-auto h-[93vh] min-w-max">
                <div className="flex-initial flex flex-col items-center gap-10 font-semibold pt-5 px-5 border-gray-300 border-r w-1/6 bg-white">
                    <span className="text-2xl">Objetos</span>
                    <button
                        className="text-white bg-purple-500 px-10 py-3 rounded-3xl w-full"
                        onClick={() => onAdd("GET")}
                    >
                        GET
                    </button>
                    <button
                        className="text-white bg-sky-500 px-10 py-3 rounded-3xl w-full"
                        onClick={() => onAdd("POST")}
                    >
                        POST
                    </button>
                    <button
                        className="text-white bg-indigo-600 px-10 py-3 rounded-3xl w-full"
                        onClick={() => onAdd("PUT")}
                    >
                        PUT
                    </button>
                    <button
                        className="text-white bg-amber-600 px-10 py-3 rounded-3xl w-full"
                        onClick={() => onAdd("PATCH")}
                    >
                        PATCH
                    </button>
                    <button
                        className="text-white bg-red-700 px-10 py-3 rounded-3xl w-full"
                        onClick={() => onAdd("DELETE")}
                    >
                        DELETE
                    </button>
                </div>
                <div className="w-full flex-auto">
                    <ReactFlow
                        nodes={nodes}
                        edges={edges}
                        onNodesChange={onNodesChange}
                        onEdgesChange={onEdgesChange}
                        onConnect={onConnect}
                        onNodeClick={(_, e) => setSelectedNode(e)}
                        fitView
                    >
                        <Controls />
                        <MiniMap />
                        <Background variant="dots" gap={12} size={1} />
                    </ReactFlow>
                </div>
                <div className="flex-initial flex flex-col items-center gap-5 font-semibold pt-5 px-5 border-gray-300 border-l w-1/6 bg-white">
                    <span className="text-2xl w-full">Propriedades</span>
                    <div>
                        <span className="text-md">Nome</span>
                        <input
                            className="border border-gray-300 rounded-md w-full"
                            type="text"
                            value={selectedNode?.data?.label || ""}
                            onChange={(e) => handleChange(e, "label")}
                        />
                    </div>
                    <div>
                        <span className="text-md">Descrição</span>
                        <textarea
                            className="border border-gray-300 rounded-md w-full"
                            type="textarea"
                            value={selectedNode?.data?.descricao || ""}
                            onChange={(e) => handleChange(e, "descricao")}
                        />
                    </div>
                    <div>
                        <span className="text-md">Corpo envio</span>
                        <textarea
                            className="border border-gray-300 rounded-md w-full"
                            type="textarea"
                            value={selectedNode?.data?.corpo_envio || ""}
                            onChange={(e) => handleChange(e, "corpo_envio")}
                        />
                    </div>
                    <div className="flex flex-col items-center gap-10">
                        <span className="text-2xl">Respostas</span>
                        <button className="text-white bg-purple-500 px-10 py-3 rounded-3xl">
                            GET
                        </button>
                        <button className="text-white bg-sky-500 px-10 py-3 rounded-3xl">
                            POST
                        </button>
                    </div>
                    <div className="w-full border-b border-gray-300"></div>
                    <div className="flex flex-col items-center gap-5">
                        <button
                            className="text-white bg-green-600 px-10 py-3 rounded-3xl"
                            onClick={handleSubmit}
                        >
                            {data?.id ? "Atualizar" : "Criar"}
                        </button>
                        {data?.id && (
                            <button
                                className="text-white bg-red-600 px-10 py-3 rounded-3xl"
                                onClick={() => destroy(`/rotas/${data.id}`)}
                            >
                                Excluir
                            </button>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
