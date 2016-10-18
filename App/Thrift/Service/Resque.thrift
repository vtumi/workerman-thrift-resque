namespace php App.Thrift.Service.Resque

struct Request {
    1: string queue,
    2: string job,
    3: optional map<string, string> params,
    4: optional bool trackStatus = false
}

exception InvalidValueException {
    1: i32 error_code,
    2: string error_msg
}

service Resque
{
    string enqueue(1:Request request) throws (1: InvalidValueException e);
}
