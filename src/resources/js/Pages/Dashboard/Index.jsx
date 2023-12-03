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
import { useCallback, useEffect, useRef, useState } from "react";
import "reactflow/dist/style.css";
import ImportSection from "@/Components/ImportSection";
import MethodsButtons from "@/Components/MethodsButtons";
import methodColors from "@/utils/methodColors";
import Select from "react-select";
import { defaultOptions } from "@/utils/defaultOptions";
import Modal from "@/Components/Modal";
import SecondaryButton from "@/Components/SecondaryButton";
import DangerButton from "@/Components/DangerButton";
import SuccessButton from "@/Components/SuccessButton";
import PurpleButton from "@/Components/PurpleButton";

export default function Dashboard({ auth, rotas, projeto_id, metodos, autenticacoes }) {
    const [nodes, setNodes, onNodesChange] = useNodesState([]);
    const [edges, setEdges, onEdgesChange] = useEdgesState([]);
    const [selectedNode, setSelectedNode] = useState(null);
    const [autenticacoesState, setAutenticacoesState] = useState(autenticacoes);
    const [modalAutenticacao, setModalAutenticacao] = useState({
        show: false,
        autenticacao_id: null,
    });

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
        corpo_envio_resposta: "",
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
                corpo_envio_resposta: [
                    {
                        corpo_json: "{}",
                        metodo: {
                            metodo: method,
                        }
                    }
                ]
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
            corpo_envio_resposta: [
                {
                    corpo_json: "{}",
                    metodo: {
                        metodo: method,
                    }
                }
            ]
        });
    };
    const handleChange = (data, prop, index) => {
        const {
            target: { value },
        } = data;
        if(index !== undefined){
            if(prop === "corpo_envio_resposta"){
            setSelectedNode({
                ...selectedNode,
                data: {
                    ...selectedNode.data,
                    corpo_envio_resposta: [
                        {
                            ...selectedNode.data.corpo_envio_resposta[index],
                            corpo_json: value,
                        },
                    ],
                },
            });

            setData({
                ...selectedNode.data,
            });
            return;
        }
    }
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

    const handleChangeAutenticacao = (data, prop, id) => {
        const {
            target: { value },
        } = data;

        const newData = autenticacoesState.map((item) => {
            if (item.id === id) {
                return {
                    ...item,
                    [prop]: value,
                };
            }
            return item;
        });

        setAutenticacoesState(newData);

    };

    const handleChangeMetodo = (data, index) => {
        const { metodo, id } = data;

        const newData = {
            ...selectedNode,
            data: {
                ...selectedNode.data,
                corpo_envio_resposta:  selectedNode.data.corpo_envio_resposta.length != 0 ? selectedNode.data.corpo_envio_resposta.map((item, i) => {
                    if(index === i){
                        return {
                            ...item,
                            metodo_id: id,
                            metodo: {
                                ...item.metodo,
                                id: id,
                                metodo: metodo,
                            },
                        };
                    }
                }) : [{
                    corpo_json: "{}",
                    metodo_id: id,
                    metodo: {
                        id: id,
                        metodo: metodo,
                    }
                }],
            },
        }

        setSelectedNode({...newData});
        setData({...newData.data});
    };


    const handleChangeRotaParametros = (data, prop, index) => {
        const {
            target: { value },
        } = data;

        setSelectedNode({
            data: {
                ...selectedNode.data,
                rota_parametros: selectedNode.data.rota_parametros.map((item, i) => {
                    if (i === index) {
                        return {
                            ...item,
                            [prop]: value,
                        };
                    }
                    return item;
                }),
            },
        });

        setData({
            ...selectedNode.data,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(data);
        router.put(`/rotas/${data.id}`, {
            ...data,
            titulo: data.label,
        });
    };

    const atualizarPosicao = (rota) => {
        try {
            router.put(`/rotas/${rota.id}/posicao`, {
                posicao_x: rota.position.x,
                posicao_y: rota.position.y,
            });
        } catch (error) {
            console.log(error);
        }
    }

    const addParameter = () => {
        setSelectedNode({
            data: {
                ...selectedNode.data,
                rota_parametros: [
                    ...selectedNode.data.rota_parametros,
                    {
                        parametro: "",
                        descricao: "",
                        exemplo: "",
                    },
                ],
            },
        });

        setData({
            ...selectedNode.data,
        });
    }

    const removeParameter = (index) => {

        const newData = {
            data: {
                ...selectedNode.data,
                rota_parametros: [
                    ...selectedNode.data.rota_parametros.slice(0, index),
                ],
            },
        }

        setSelectedNode(newData);

        setData(newData.data);
    }

    const handleDelete = (id) => {
        destroy(`/rotas/${data.id}`)
        setSelectedNode({})
    }

    const handleChangeAuth = (data) => {
        setSelectedNode({
            ...selectedNode,
            data: {
                ...selectedNode.data,
                autenticacao_id: data.id,
                autenticacao: {
                    ...data,
                    id: data.id,
                    tipo_autenticacao: data.tipo_autenticacao
                }
            }
        })

        setData({
            ...selectedNode.data
        })
    }

    useEffect(() => {
        setNodes((nds) =>
        nds.map((node) => {
            if (node.id === selectedNode?.id) {
                    node.data = {
                        ...node.data,
                        ...selectedNode.data,
                    };

                    atualizarPosicao(node);

                    setData({
                        ...selectedNode.data,
                    });
                }
                return node;
            })
        );
    }, [selectedNode, setNodes]);

    useEffect(() => {
        let column = 0;
        setNodes((nds) =>
        rotas.map((rota, i) => {
                let padLeft = 0;
                column = i;
                if(i > 10 && column != Number(String(i).charAt(0))) padLeft = Number(String(i).charAt(0));
                if(i > 10) column = Number(String(i).charAt(1));
                const node = {
                    ...nds,
                    id: rota.id,
                    data: {
                        label: rota.rota,
                        ...rota,
                    },
                    position: {
                        x: rota.posicao_x || padLeft * 200,
                        y: rota.posicao_y || column * 60,
                    },
                    style: {
                        backgroundColor: methodColors(rota?.corpo_envio_resposta[0]?.metodo?.metodo).background,
                        color: methodColors(rota?.corpo_envio_resposta[0]?.metodo?.metodo).color
                    },
                    width: 100 + rota.rota.length * 10,
                    height: 100,
                };
                return node;
            })
        );
    }, [rotas]);

    return (
        <AuthenticatedLayout user={auth}>
            <Head title="Dashboard" />
            <div className="flex flex-1 h-[93vh] min-w-max">
                <div className="flex-none flex flex-col items-center gap-10 font-semibold pt-5 px-5 border-gray-300 border-r
                max-w-5xl bg-white overflow-y-auto pb-5">
                    <span className="text-2xl">Métodos</span>
                    <MethodsButtons onClickButton={() => onAdd('GET')} method={'GET'} />
                    <MethodsButtons onClickButton={() => onAdd('POST')} method={'POST'} />
                    <MethodsButtons onClickButton={() => onAdd('PUT')} method={'PUT'} />
                    <MethodsButtons onClickButton={() => onAdd('PATCH')} method={'PATCH'} />
                    <MethodsButtons onClickButton={() => onAdd('DELETE')} method={'DELETE'} />
                    {
                        autenticacoesState.length > 0 && (
                            <>
                                <div className="w-full border-b border-gray-300"></div>
                                <div className="flex flex-1 flex-col gap-5 text-center">
                                    <span className="text-2xl">Autenticações</span>
                                    <div className="flex flex-auto gap-2 max-w-md flex-wrap justify-center">
                                        {
                                            autenticacoes?.map((item, i) => (
                                                <PurpleButton
                                                key={item.id}
                                                onClick={() => setModalAutenticacao({...modalAutenticacao, show: true, autenticacao_id: item.id})}
                                                >
                                                    {item.tipo_autenticacao}
                                                </PurpleButton>
                                            ))
                                        }
                                    </div>
                                    <SuccessButton
                                    onClick={() => setModalAutenticacao({...modalAutenticacao, show: true, autenticacao_id: 'new'})}

                                    >
                                        Adicionar nova autenticação
                                    </SuccessButton>
                                </div>
                            </>
                        )
                    }
                    <div className="w-full border-b border-gray-300"></div>
                    <div className="flex flex-1 gap-5">
                        <ImportSection projeto_id={projeto_id}/>
                    </div>
                </div>
                <div className="w-full flex-auto">
                    <ReactFlow
                        nodes={nodes}
                        edges={edges}
                        onNodesChange={onNodesChange}
                        onEdgesChange={onEdgesChange}
                        onConnect={onConnect}
                        onNodeClick={(_, e) => setSelectedNode(e)}
                        onNodeDragStop={(_,e) => atualizarPosicao(e)}
                        fitView
                    >
                        <Controls />
                        <MiniMap />
                        <Background variant="dots" gap={12} size={1} />
                    </ReactFlow>
                </div>
                <div className="flex-none flex flex-col items-center gap-5 font-semibold pt-5 px-5 border-gray-300 border-l w-1/6 bg-white overflow-y-auto pb-2 max-w-5xl">
                    <span className="text-2xl w-full">Propriedades</span>
                    <div>
                        <span className="text-md">Nome *</span>
                        <input
                            className="border border-gray-300 rounded-md w-full"
                            type="text"
                            value={selectedNode?.data?.label || ""}
                            onChange={(e) => handleChange(e, "label")}
                        />
                    </div>
                    <div>
                        <span className="text-md">Descrição *</span>
                        <textarea
                            className="border border-gray-300 rounded-md w-full"
                            type="textarea"
                            required
                            value={selectedNode?.data?.descricao || ""}
                            onChange={(e) => handleChange(e, "descricao")}
                        />
                    </div>
                    <div>
                        <span className="text-md">Corpo envio *</span>
                        <textarea
                            className="border border-gray-300 rounded-md w-full"
                            type="textarea"
                            required
                            value={selectedNode?.data?.corpo_envio_resposta[0]?.corpo_json || ""}
                            onChange={(e) => handleChange(e, "corpo_envio_resposta", 0)}
                        />
                    </div>
                    <div>
                        <span className="text-md">Metodo do corpo *</span>
                        <Select
                            className="mt-5"
                            options={metodos}
                            required
                            defaultOption={metodos[0]}
                            getOptionValue={(option) => option.id}
                            getOptionLabel={(option) => option.metodo}
                            value={metodos.find(item => item.metodo === selectedNode?.data?.corpo_envio_resposta[0]?.metodo?.metodo)}
                            onChange={(e) => handleChangeMetodo(e, 0)}
                            styles={{
                                control: (base, state) => ({
                                    ...base,
                                    position: 'relative',
                                    paddingLeft: '1.5em',
                                    color: methodColors(selectedNode?.data?.corpo_envio_resposta[0]?.metodo?.metodo).background,
                                    '::before': {
                                        content: '"\\2022"',
                                        position: 'absolute',
                                        left: '0.2em',
                                        top: '1',
                                        fontSize: '2em',
                                        color: methodColors(selectedNode?.data?.corpo_envio_resposta[0]?.metodo?.metodo).background,
                                    },
                                }),
                            }}
                        />
                    </div>
                    {
                        selectedNode?.data && (
                            <>
                                <div className="w-full border-b border-gray-300"></div>
                                <span className="text-2xl w-full">Parametros</span>
                            </>
                        )
                    }
                    {
                        selectedNode?.data?.rota_parametros?.map((item, i) => (
                            <div key={item.id} className="text-center">
                                {i > 0 && <div className="w-full border-b border-gray-300 mb-2"></div>}
                                <span className="text-md">Parametro</span>
                                <input
                                    className="border border-gray-300 rounded-md w-full"
                                    type="text"
                                    value={item.parametro || ""}
                                    onChange={(e) => handleChangeRotaParametros(e, "parametro", i)}
                                />
                                <span className="text-md">Descrição</span>
                                <textarea
                                    className="border border-gray-300 rounded-md w-full"
                                    type="textarea"
                                    value={item.descricao || ""}
                                    onChange={(e) => handleChangeRotaParametros(e, "descricao", i)}
                                />
                                <span className="text-md">Exemplo</span>
                                <input
                                    className="border border-gray-300 rounded-md w-full"
                                    type="text"
                                    value={item.exemplo || ""}
                                    onChange={(e) => handleChangeRotaParametros(e, "exemplo", i)}
                                />
                                <DangerButton className="mt-5" onClick={() => removeParameter(i)}>
                                    Remover parametro
                                </DangerButton>
                            </div>
                        ))
                    }
                    {
                        selectedNode?.data && (
                            <>
                                <SuccessButton
                                    onClick={addParameter}
                                >Adicionar parametro
                                </SuccessButton>
                                <div className="w-full border-b border-gray-300"></div>
                            </>
                        )
                    }
                    {
                        selectedNode?.data && (
                            <>
                                <span className="text-2xl w-full">Autenticações</span>
                                <Select
                                    name="colors"
                                    value={selectedNode?.data?.autenticacao ? {
                                        id: selectedNode?.data?.autenticacao?.id,
                                        tipo_autenticacao: selectedNode?.data?.autenticacao?.tipo_autenticacao,
                                    } : null
                                    }
                                    onChange={(e) => handleChangeAuth(e)}
                                    options={autenticacoes}
                                    getOptionValue={(option) => option.id}
                                    getOptionLabel={(option) => option.tipo_autenticacao}
                                    className="basic-multi-select"
                                    classNamePrefix="select"
                                    placeholder={"Selecione..."}
                                />
                                <div className="w-full border-b border-gray-300"></div>
                            </>
                        )
                    }
                    <div className="flex flex-col items-center gap-5">
                        {selectedNode?.data?.id && (
                            <>
                                <SuccessButton
                                    onClick={handleSubmit}
                                >
                                    {data?.id ? "Atualizar" : "Criar"}
                                </SuccessButton>
                                <DangerButton
                                    onClick={() => handleDelete(data.id)}
                                >
                                    Excluir
                                </DangerButton>
                            </>
                        )}
                    </div>
                </div>
            </div>
            <Modal show={modalAutenticacao.show} onClose={() => setModalAutenticacao({...modalAutenticacao, show:false})}>
                {
                    () => {
                        const autenticacao = autenticacoesState.find(item => item.id === modalAutenticacao.autenticacao_id);
                        return (
                            <div className="p-6 flex flex-col gap-5">
                                <div>
                                    <h2 className="text-lg font-medium text-gray-900 pb-2">
                                        Tipo de autenticaçao
                                    </h2>
                                    <input
                                        className="border border-gray-300 rounded-md w-full"
                                        type="text"
                                        value={autenticacao?.tipo_autenticacao || ""}
                                        onChange={(e) => handleChangeAutenticacao(e, "tipo_autenticacao", autenticacao.id)}
                                    />
                                </div>
                                <div>
                                    <h2 className="text-lg font-medium text-gray-900 pb-2">
                                        Descrição
                                    </h2>
                                    <input
                                        className="border border-gray-300 rounded-md w-full"
                                        type="text"
                                        value={autenticacao?.descricao || ""}
                                        onChange={(e) => handleChangeAutenticacao(e, "descricao", autenticacao.id)}
                                    />
                                </div>
                                <div>
                                    <h2 className="text-lg font-medium text-gray-900 pb-2">
                                        Local envio
                                    </h2>
                                    <input
                                        className="border border-gray-300 rounded-md w-full"
                                        type="text"
                                        value={autenticacao?.local_envio || ""}
                                        onChange={(e) => handleChangeAutenticacao(e, "local_envio", autenticacao.id)}
                                    />
                                </div>
                                <div>
                                    <h2 className="text-lg font-medium text-gray-900 pb-2">
                                        Chave
                                    </h2>
                                    <input
                                        className="border border-gray-300 rounded-md w-full"
                                        type="text"
                                        value={autenticacao?.chave || ""}
                                        onChange={(e) => handleChangeAutenticacao(e, "chave", autenticacao.id)}
                                    />
                                </div>
                                <div className="mt-6 flex justify-end">
                                    <SecondaryButton onClick={() => setModalAutenticacao({...modalAutenticacao, show: false })}>
                                        Cancelar
                                    </SecondaryButton>

                                    <SuccessButton className="ml-3">
                                        {autenticacao?.id ? "Atualizar" : "Criar"}
                                    </SuccessButton>
                                </div>
                            </div>
                        )
                    }

                }

            </Modal>

        </AuthenticatedLayout>
    );
}
