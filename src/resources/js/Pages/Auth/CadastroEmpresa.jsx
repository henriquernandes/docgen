import { useEffect } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError";


const CadastroEmpresa = () => {
    const { data, setData, post, processing, errors, reset } = useForm({
        nome: '',
        email: '',
        password: '',
        password_confirmation: '',
        empresa_nome: '',
        empresa_email: '',
        cnpj: '',
    });

    const handleChange = event => {
        setData({...data, [event.target.id]: event.target.value});
    }

    console.log(errors)

    const submitForm = event => {
        event.preventDefault()

        post(route('cadastro-empresa.store'))
    }

    return (
        <GuestLayout>
            <Head title="Cadastro Empresa" />

                <form onSubmit={submitForm}>
                    <h3 className="text-2xl font-semibold pb-4">Cadastro empresa</h3>
                    <div className="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel htmlFor="nome" value={'Nome'} />

                            <TextInput
                                id="nome"
                                type="text"
                                value={data.nome}
                                className="block mt-1 w-full"
                                onChange={handleChange}
                                required
                                autoFocus
                            />

                            <InputError message={errors.nome} className="mt-2" />

                            {/* Email Address */}
                            <div className="mt-4 flex flex-col">
                                <InputLabel htmlFor="email" value='Email'/>

                                <TextInput
                                    id="email"
                                    type="email"
                                    name="email"
                                    value={data.email}
                                    className="mt-1 block w-full"
                                    autoComplete="username"
                                    onChange={(e) => setData("email", e.target.value)}
                                    required
                                />

                                <InputError message={errors.email} className="mt-2" />
                            </div>

                            {/* Senha */}
                            <div className="mt-4">
                                <InputLabel htmlFor="password">Senha</InputLabel>

                                <TextInput
                                    id="password"
                                    type="password"
                                    value={data.password}
                                    className="block mt-1 w-full"
                                    onChange={handleChange}
                                    required
                                    autoComplete="new-password"
                                />

                                <InputError
                                    message={errors.password}
                                    className="mt-2"
                                />
                            </div>
                            <InputError message={errors.name} className="mt-2" />
                        </div>
                        <div>
                            <InputLabel htmlFor="empresa_nome">Nome da empresa</InputLabel>

                            <TextInput
                                id="empresa_nome"
                                type="text"
                                value={data.empresa_nome}
                                className="block mt-1 w-full"
                                onChange={handleChange}
                                required
                                autoFocus
                            />

                            <InputError message={errors.empresa_nome} className="mt-2" />

                            {/* Email Address */}
                            <div className="mt-4">
                                <InputLabel htmlFor="empresa_email">Email da empresa</InputLabel>

                                <TextInput
                                    id="empresa_email"
                                    type="email"
                                    value={data.empresa_email}
                                    className="block mt-1 w-full"
                                    onChange={handleChange}
                                    required
                                />

                                <InputError message={errors.empresa_email} className="mt-2" />
                            </div>

                            {/* Confirmar Senha */}
                            <div className="mt-4">
                                <InputLabel htmlFor="password_confirmation">
                                    Confirmar Senha
                                </InputLabel>

                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    value={data.password_confirmation}
                                    className="block mt-1 w-full"
                                    onChange={handleChange}
                                    required
                                />

                                <InputError
                                    message={errors.password_confirmation}
                                    className="mt-2"
                                />
                            </div>
                        </div>
                    </div>


                    <div className="flex items-center justify-end mt-4">
                        <Link
                            href="/login"
                            className="underline text-sm text-gray-600 hover:text-gray-900">
                            Já cadastrado?
                        </Link>

                        <PrimaryButton className="ml-4">Cadastrar empresa</PrimaryButton>
                    </div>
                </form>
        </GuestLayout>
    )
}

export default CadastroEmpresa
